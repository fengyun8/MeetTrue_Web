<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Utils\LogUtil;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Exception;
use Monolog\Logger;
use Auth;
use Validator;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    // 邮件找回密码 Subject
    protected $subject = '觅处｜Meet－True密码取回 ';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * // 422: 找不到对应的邮箱用户
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        // Check Email
        $this->validate($request, ['email' => 'required|email']);

        try {
            // Send Email
            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
        } catch (Exception $e) {
            LogUtil::error("重置密码邮件失败: " . $e->getMessage(), ['error' => $e]);
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, '邮件发送失败,工程师正在紧急恢复中,敬请谅解!');
        }

        // Handle Result
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE);

            case Password::INVALID_USER:
                return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, trans($response));
        }
    }

    public function postResetByPhone(Request $request)
    {
        $data['password'] = $request->input('password');

        $validator = Validator::make($data, [
        'password'     => 'required|min:6|max:12|confirmed'
        ]);

        if ($validator->fails()) {

            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                $this->formatErrors($validator)
            );
        }
        if (Auth::check()) {
            $user = Auth::user();
            $user->password = bcrypt($data['password']);
            $user->save();

            Auth::logout();
            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE,
                '密码重置成功'
            );

        return $this->jsonReturn(
            StatusCodeEnum::ERROR_CODE,
            '密码重置失败'
        }
    }
}
