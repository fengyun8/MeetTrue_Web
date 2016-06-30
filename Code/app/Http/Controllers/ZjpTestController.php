<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PhpSms;
use Validator;
use Toplan\Sms\Storage;

class ZjpTestController extends Controller
{
    const STATE_KEY = '_state';

    const DYNAMIC_RULE_KEY = '_dynamic_rule';

    const CAN_RESEND_UNTIL_KEY = '_can_resend_until';

    const VERIFY_SMS_TEMPLATE_KEY = 'verifySmsTemplateId';

    const VOICE_VERIFY_TEMPLATE_KEY = 'voiceVerifyTemplateId';

    protected static $storage;

    protected $token = '12345678';

    public function getTest()
    {
        $data = [];
        $data['mobile'] = '13666643039';
        $data['interval'] = 60; 

        $result = $this->validateSendable(60);
        $result = $this->validateFields($data);

        dd($result);

    }
        protected static function getFields()
    {

        return array_keys(config('laravel-sms.validation', []));
    }
        protected static function getValidationConfigByField($field)
    {
        $data = config('laravel-sms.validation', []);

        if (isset($data[$field])) {
            return $data[$field];
        }
        throw new LaravelSmsException("Don't find validation config for the field [$field] in config file, please define it.");
    }

    protected static function whetherValidateFiled($field)
    {
        $data = self::getValidationConfigByField($field);

        return isset($data['enable']) && $data['enable'];
    }
     public function validateFields(array $data)
    {
        if (empty($data)) {
            return self::generateResult(false, 'empty_data');
        }

        $dataForValidator = [];
        $fields = self::getFields();
        foreach ($fields as $field) {
            if (self::whetherValidateFiled($field)) {
                $ruleName = isset($data[$field . '_rule']) ? $data[$field . '_rule'] : '';
                $dataForValidator[$field] = $this->getRealRuleByName($field, $ruleName);
            }
        }
        $validator = Validator::make($data, $dataForValidator);

        if ($validator->fails()) {
            $messages = $validator->errors();
            foreach ($fields as $field) {
                if ($messages->has($field)) {
                    $rule = $this->getNameOfUsedRule($field);
                    $msg = $messages->first($field);

                    return self::generateResult(false, $rule, $msg);
                }
            }
        }

        return self::generateResult(true, 'success');
    }


    public function validateSendable($interval)
    {
        $interval = intval($interval);
        $time = $this->getCanResendTime();

        if ($time <= time()) {
            return self::generateResult(true, 'can_send');
        }

        return self::generateResult(false, 'request_invalid', [$interval]);
    }

    protected static function generateResult($pass, $type, $message = '', $data = [])
    {
        $result = [];
        $result['success'] = (bool) $pass;
        $result['type'] = $type;

        if (is_array($message)) {
            $data = $message;
            $message = '';
        }
        $message = $message ?: self::getNotifyMessage($type);
        $result['message'] = self::vsprintf($message, $data);


        return $result;
    }

        protected static function getNotifyMessage($name)
    {
        $messages = config('laravel-sms.notifies', []);
        if (array_key_exists($name, $messages)) {
            return $messages["$name"];
        }

        return $name;
    }

    protected static function vsprintf($template, array $data)
    {
        if (!is_string($template)) {
            return '';
        }
        if ($template && count($data)) {
            try {
                $template = vsprintf($template, $data);
            } catch (\Exception $e) {
                // swallow exception
            }
        }

        return $template;
    }



    public function getCanResendTime()
    {
        // $key = laravel_sms.12345678._can_resend_until
        // $key = config(laravel_sms.prefix . $token . CAN_RESEND_UNTIL_KEY)
        $key = $this->generateKey(self::CAN_RESEND_UNTIL_KEY);
        $result =  (int) self::storage()->get($key, 0);
        return $result;
    }

    protected static function storage()
    {
        if (self::$storage) {
            return self::$storage;
        }
        
        $className = self::getStorageClassName();
     //   dd($className);


        if (!class_exists($className)) {
            throw new LaravelSmsException("Failed to generator store, the class [$className] does not exists.");
        }

        $store = new $className();
        if (!($store instanceof Storage)) {
            throw new LaravelSmsException("Failed to generator store, the class [$className] does not implement the interface [Toplan\\Sms\\Storage].");
        }

        return self::$storage = $store;

    }

    protected static function getStorageClassName()
    {
        $className = config('laravel-sms.storage', null);

        if ($className && is_string($className)) {
            return $className;
        }
    }

    protected function generateKey()
    {
        $split = '.';
        $prefix = config('laravel-sms.prefix', 'laravel_sms');
        // 拿到参数，变成数组
        $args = func_get_args();
        // 将$this->token 插入到$args数组的第一个位置
        array_unshift($args, $this->token);

        array_unshift($args, 12345);

        // 返回值为字符串的
        $args = array_filter($args, function ($value) {
            return $value && is_string($value);
        });

        if (count($args)) {
            $prefix .= $split . implode($split, $args);
        }

        return $prefix;
    }

    public function getUseGenerateKey()
    {
        return $this->getGenerateKey();
    }
}
