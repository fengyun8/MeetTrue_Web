<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Enums\StatusCodeEnum;
use SmsManager;
use Validator;
use Input;
use App\User;
use Auth;

/**
 * 短信发送，SmsManager门面对应 vendor\Topan\LaravelSms\SmsManager
 */
class SmsController extends Controller
{
    /**
     * http://domain/sms/info 查看laravel sms信息  
     * 
     */
    public function getInfo()
    {
        $html = '<meta charset="UTF-8"/><h2 align="center" style="margin-top: 30px;margin-bottom: 0;">Laravel Sms 调试信息</h2>';
        $html .= '<hr>';
        $html .= '<p>你可以在调试模式(设置config/app.php中的debug为true)下查看到存储在存储器中的验证码短信/语音相关数据:</p>';
        echo $html;
        if (config('app.debug')) {
            dump(SmsManager::retrieveAllData());
        } else {
            echo '<p align="center" style="color: red;">现在是非调试模式，无法查看调试数据</p>';
        }
    }

    /**
     * 发送短信验证码
     * 
     * @param  Request $request
     * @return [type]           [description]
     */
    public function postSendCode(Request $request)
    {
        $mobile = $request->input('mobile', null);
        $interval = $request->input('interval', 60);
        $data = ['mobile' => $mobile, 'interval' => $interval, 'mobile_rule' => 'mobile_required'];

        $res = SmsManager::validateSendable($interval);
        if (!$res['success']) {

            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE, 
                $res['message']
            );
        }

        $res = SmsManager::validateFields($data);
        if (!$res['success']) {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE, 
                $res['message']
            );
        }

        $res = SmsManager::requestVerifySms($mobile, $interval);

        if (!$res['success']) {
            if ($res['logs']['0']['result']['code'] == 22 ) {
            return $this->jsonReturn(22, '该小时获取次数超过上限，过1小时再来吧');
            } elseif ($res['logs']['0']['result']['code'] == 17) {
                return $this->jsonReturn(17, '今天获取次数超过上限，明天再来吧');
            } else {
                return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, '验证码发送失败');
            }
        }

        return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE, '验证码成功发送，请立即验证');
    }

       /**
     * 验证短信码是否正确
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postVerifyCode(Request $request) 
    {
         $mobile = $request->input('mobile');
        // $data = Input::all();
        // $data['mobile_rule'] = 'mobile_required';
        // $validator = Validator::make($data, [
        // 'mobile'     => 'required|confirm_mobile_not_change',
        // 'verifyCode' => 'required|verify_code|confirm_rule:mobile,mobile_required',
        // ]);

        // if ($validator->fails()) {
        //     SmsManager::forgetState();

        //     return $this->jsonReturn(
        //         StatusCodeEnum::ERROR_CODE,
        //         $this->formatErrors($validator)
        //     );
        // }

        if(Auth::check()) {
            $user = Auth::user();
            $user->mobile = $mobile;
            $user->save();

            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE,
                '手机重新绑定成功'
            );

        } elseif ($user = User::where('mobile', $mobile)->first()) {
            $user->remember_token = $token = str_random(60);
            $user->save();

            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE,
                'success', 
                compact('token')
            ); 

        } else {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                '账户不存在'
            ); 
        }
    }
}
