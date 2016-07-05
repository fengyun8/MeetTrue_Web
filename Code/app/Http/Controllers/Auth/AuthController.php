<?php

namespace App\Http\Controllers\Auth;

use App\Enums\CacheKeyPrefixEnum;
use App\Exceptions\SelfExceptions\ValidatorApiException;
use App\User;
use App\Utils\LogUtil;
use App\Utils\TokenUtil;
use App\Utils\ValidateTrait;
use Auth;
use Illuminate\Support\Arr;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Enums\StatusCodeEnum;
use SmsManager;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ValidateTrait;

    /**
     * 登录成功跳转的路径，这里按要求自己设置
     * @var string
     */
    protected $redirectPath = '/';

    /**
     * 登录失败跳转的路径
     * @var string
     */
    protected $loginPath = '/auth/login';

    /**
     * 构造函数，所有的函数经过guest中间件的验证
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'getLogout']);
        $this->middleware('auth', ['only' => 'postBindMail']);
    }

    /**
     * 覆盖Illuminate\Foundation\Auth\RegistersUsers中的postRegister方法
     * 其中$this->jsonReturn,$this->formatErrors来自Utils\ReturnTrait类
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        // 验证失败
        if ($validator->fails()) {
            SmsManager::forgetState();
            return redirect('auth/register')
                ->withErrors($validator);
        }

        // 验证成功
        Auth::login($this->create($request->all()));

        return redirect()->intended($this->redirectPath());
    }

    /**
     * 注册时的字段验证.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|min:6｜max:12',
            'mobile'     => 'required|zh_mobile|unique:users|confirm_mobile_not_change',
            'verifyCode' => 'required|verify_code',
        ]);
    }

    /**
     * 注册时通过验证，将该用户记录插入到users表中
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'nickname' => $this->defaultNickname(),
            'mobile' => $data['mobile'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * 刚注册的nickname给一个mt_随机整数
     * @return String  [eg: mt_0845297613]
     */
    private function defaultNickname() 
    {
        $result = 'mt_';
        $arr=range(0,9);
        shuffle($arr);
        foreach($arr as $value) {
          $result .= $value; 
        }

        return $result;
    }

    /**
     * 用户使用邮件或者手机号登录
     * @param  Request $request 
     * @return [type]           [description]
     */
    public function postLogin(Request $request)
    {
        $credentials = $request->input('credential');
        $password = $request->input('password');
        $remember = $request->has('remember');

        if($credentials == '' || $password == '') {
            return redirect($this->loginPath())
                ->withErrors(['password' => '账户和密码都不能为空']);
        }

        // 尝试登录,成功则成为已登录状态
        $result = Auth::attempt(['email' => $credentials, 'password' => $password], $remember) || Auth::attempt(['mobile' => $credentials, 'password' => $password], $remember);
        
        if(!$result) {
            return redirect($this->loginPath())
                ->withErrors(['password' => '账户和密码不匹配']);
        } elseif ($request->has('redirect_url')) {
            return redirect()->to($request->input('redirect_url'));
        } else {
            return redirect()->intended($this->redirectPath());
        }
    }

    /**
     * 绑定邮箱
     * Error - key:
     *      email
     */
    public function postBindMail(Request $request)
    {
        // Get params
        $email = $request->input('email');

        // Check Email
        $this->validateForApi($request, [
            'email' => 'required|email',
        ]);
        // Exists Email
        if (\App\User::where('email', '=', $email)->exists()) {
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['email' => trans('auth.exists.email')]);
        }

        // 生成 token
        $token = TokenUtil::createToken();

        // 存入缓存(mt_password_reset)，并设置时间
        \Cache::put(CacheKeyPrefixEnum::BIND_MAIL . $token, [
            'email' => $email,
            'user_id' => \Auth::user()->id
        ], 24*60);

        // 发送邮件（队列）
        \Mail::send('emails.bindMail', compact('token'), function ($message) use ($email) {
            $message->subject('觅处｜Meet－True绑定邮箱 ');
            $message->to($email);
        });

        return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE);
    }

    /**
     * 绑定邮箱链接验证
     * Error - key:
     *      token
     *      other
     */
    public function getBindMailByToken($token)
    {
        // Get email by token
        $params = \Cache::get(CacheKeyPrefixEnum::BIND_MAIL . $token);

        // Check params
        if (empty($params)) {
            // TODO token出错时，应该跳转页面
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['token' => trans('auth.bindMail.token')]);
        }
        if (!Arr::has($params, 'email') || !Arr::has($params, 'user_id')) {
            // TODO token出错时，应该跳转页面
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['token' => trans('auth.bindMail.token')]);
        }

        // Update user
        if (!\App\User::updateByUserId($params['user_id'], ['email' => $params['email']])) {
            // update fail
            LogUtil::error('bindMailByToken:用户邮箱更新失败', $params);
            // TODO token出错时，应该跳转页面
            return $this->jsonReturn(StatusCodeEnum::ERROR_CODE, ['other' => '更新失败']);
        }

        // Delete token
        \Cache::forget(CacheKeyPrefixEnum::BIND_MAIL . $token);

        return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE);
    }
}
