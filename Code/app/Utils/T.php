<?php

namespace App\Utils;

use Toplan\Sms\SmsManager;
use PhpSms;
use Validator;
use SmsManager as TT;


class T extends SmsManager {
    /**
     * 请求验证码短信
     *
     * @param string $for
     * @param int    $interval
     *
     * @return array
     */
    public function requestsssss($for, $interval)
    {
        $code = self::generateCode();
        $minutes = self::getCodeValidMinutes();
        $templates = self::getTemplatesByKey(self::VERIFY_SMS_TEMPLATE_KEY);
        $content = self::generateSmsContent([$code, $minutes]);

        $result = PhpSms::make($templates)->to($for)
            ->data(['code' => $code, 'minutes' => $minutes])
            ->content($content)->send();

            // dd($result);

            // dd($result);
        // if ($result === null || $result === true || (isset($result['success']) && $result['success'])) {
            $this->state['sent'] = true;
            $this->state['to'] = $for;
            $this->state['code'] = $code;
            $this->state['result'] = $result;
            $this->state['deadline'] = time() + ($minutes * 60);


            // $t = session('laravel_sms._state');
            // dd($t);


            // dd($this->state);
            // dd("Fsaf");
            $this->storeState();
            $this->setCanResendAfter($interval);

            $t = session('laravel_sms._state');
            dd($t);

            // return self::generateResult(true, 'sms_sent_success');
        // }

        return self::generateResult(false, 'sms_sent_failure');
    }
}