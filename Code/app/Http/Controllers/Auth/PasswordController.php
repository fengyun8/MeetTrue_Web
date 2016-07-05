<?php

namespace App\Http\Controllers\Auth;

use App\Enums\OperateLogTypeEnum;
use App\Enums\StatusCodeEnum;
use App\Events\ResetPasswordEvent;
use App\Http\Controllers\Controller;
use App\Utils\LogUtil;
use App\Utils\ValidateTrait;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Exception;
use Monolog\Logger;
use App\User;
use Validator;
use Auth;

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

    use ResetsPasswords, ValidateTrait;

    // 邮件找回密码 Subject
    protected $subject = '觅处｜Meet－True密码取回 ';

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest', ['except' => 'postResetByPhone']);
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
        $this->validateForApi($request, ['email' => 'required|email']);

        try {
            // Send Email
            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
        } catch (Exception $e) {
            LogUtil::error("重置密码邮件失败: " . $e->getMessage(), ['error' => $e]);
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['email' => '邮件发送失败,工程师正在紧急恢复中,敬请谅解!']);
        }

        // Handle Result
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE);

            case Password::INVALID_USER:
                return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['email' => trans($response)]);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postResetByEmail(Request $request)
    {
        $this->validateForApi($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        // Reset Password
        $response = Password::reset($credentials, function ($user, $password) {
            // Help the user login the system
            $this->resetPassword($user, $password);
        });

        // return
        switch ($response) {
            case Password::PASSWORD_RESET:

                // Operate Log
                \Event::fire(new ResetPasswordEvent(Auth::user(), OperateLogTypeEnum::RESET_PASSWORD_BY_EMAIL, [
                    'email' => $request->input('email')
                ]));
                // Logout
                Auth::logout();

                return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE);

            default:
                // TODO token出错时，应该跳转页面
                return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['email' => trans($response)]);
        }
    }

    public function postResetByPhone(Request $request)
    {
        $token = $request->input('token','这里千万不要去掉@#$&*_)(*');
        $data['password'] = $request->input('password');
        $data['password_confirmation'] = $request->input('password_confirmation');

        $validator = Validator::make($data, [
            'password'     => 'required|min:6|max:12|confirmed'
        ]);

        if ($validator->fails()) {

            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                $this->formatErrors($validator)
            );
        }

        $user = User::where('remember_token', $token)->first();
        if ($user) {
            $user->password = bcrypt($data['password']);
            $user->save();

            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE,
                '密码重置成功'
            );
        } else {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                '非正常渠道重置密码，失败'
            );
        }
    }

    public function getSendEmailSuccess()
    {
        return view('auth/sendEmailSuccess');
    }

    public function getResetSuccess()
    {
        return view('auth/resetSuccess');
    }
}
