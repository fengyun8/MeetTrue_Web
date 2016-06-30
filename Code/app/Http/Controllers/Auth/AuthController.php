<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\Enums\StatusCodeEnum;
use SmsManager;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    /**
     * 构造函数，所有的函数经过guest中间件的验证
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'getLogout']);
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

            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                $this->formatErrors($validator)
            );
        }

        // 验证成功
        Auth::login($this->create($request->all()));

        return $this->jsonReturn(
            StatusCodeEnum::SUCCESS_CODE, 
            '注册成功'
        );
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
            'password' => 'required|min:6',
            'mobile'     => 'required|zh_mobile|unique:users',
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
     * 忘记密码
     */
    public function getForgetpwd()
    {
        return view('auth/forgetpwd');
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
}
