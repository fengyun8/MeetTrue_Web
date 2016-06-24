<?php

namespace App\Http\Controllers;

use App;
use App\Exceptions\ApiConstants as ApiExceptionConstants;
use App\Exceptions\ApiHandler;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use App\Exceptions\SelfExceptions\NoLoginException;
use App\Enums\ApiExceptionEnum;
use Config;
use Illuminate\Support\Arr;

class ApiController extends Controller
{

    /**
     * Construct Function
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // 接管异常
        App::singleton(
            'Illuminate\Contracts\Debug\ExceptionHandler',
            ApiHandler::class
        );
    }

    /**
     * api 网关接口
     * @param Request $request
     * @return mixed
     * @throws NoLoggedInUserException
     *
     * 请求示例
        array:7 [
        "api" => "auth.login"
        "data" => "{"key" : "value","ming" : "sss"}"
        "_appkey" => "eN3AQjZp2O2TUSnyQpJ1G9Ckzo9SQcqx"
        "_v" => "1"
        "_device" => "ios"
        "_t" => "1466759767"
        "sign" => "a36e19d286c4126b6022384586e451a920ababe6"
        ]
     */
    public function gateway(Request $request)
    {
        // need Auth接口
        $authentication = [
            'auth.register'
        ];
        // app config
        $configClients = Config::get('app.clients');

        // get params
        $appKey = $request->input('_appkey');
        $v = $request->input('_v');
        $device = $request->input('_device');
        $requestTimestamp = $request->input('_t');
        $apiName = $request->input('api', '');
        $sign = $request->input('sign');

        // check sign and 本地环境不校验签名
        if ( !Config::get('app.debug') ) {

            // http expired error
            $_timeDiff = (time() - $requestTimestamp);
            if ( $_timeDiff < 0 || $_timeDiff > Arr::get($configClients, "$device.expired_time", 30)) {
                throw new AccessDeniedHttpException(ApiExceptionEnum::SYSTEM_EXPIRED_ERROR);
            }
            // device not exists
            if (!Arr::has($configClients, $device)) {
                throw new AccessDeniedHttpException(ApiExceptionEnum::SYSTEM_DEVICE_NOT_EXIST);
            }
            // appkey is wrong
            if ($appKey != Arr::get($configClients, "$device.app_key")) {
                throw new AccessDeniedHttpException(ApiExceptionEnum::SYSTEM_APPKEY_ERROR);
            }
            // appsecret is wrong
            if (!$this->_checkSign($request->all(), Arr::get($configClients, "$device.app_secret"), $sign)) {
                throw new AccessDeniedHttpException(ApiExceptionEnum::SYSTEM_SIGN_ERROR);
            }
        }

        // check auth
        if (in_array($apiName, $authentication) && !Auth::check()) {
            throw new NoLoginException('请先登录');
        }


        // 调用接口
        list($class, $method) = explode('.', $request->input('api'));
        $class = sprintf('\App\Http\Api\V%s\%sApi', $v,ucwords(strtolower($class)));
        try {
            return App::call($class . '@' . $method);
        } catch (\ReflectionException $e) {
            throw new BadRequestHttpException(ApiExceptionEnum::SYSTEM_API_NOT_EXISTS, $e);
        }
    }

    /**
     * 检验签名
     *
     * @param $params
     * @param $secret
     * @param $sign
     * @return bool
     */
    private function _checkSign($params, $secret, $sign)
    {
        unset($params['sign']);
        ksort($params);
        $str = '';
        foreach($params as $k => $v) {
            $str .= "&$k=$v";
        }
        $str .= $secret;
        $str = substr($str, 1);

        return $sign == sha1($str);
    }
}