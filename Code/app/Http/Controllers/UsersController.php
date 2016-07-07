<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Enums\StatusCodeEnum;
use Hash;
use Validator;
use App\User;

class UsersController extends Controller
{
    /**
     *  该控制器的很多方法都只有登录后的用户才能访问
     *  使用auth中间件，过滤掉未登录用户
     */
    public function __construct()
    {
        // TODO 模拟登陆
        Auth::loginUsingId(1);
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
    {
        // Get user
        $user = User::findOrFail($userId);
        /**
         * 资料:
         *      avatar: aAvatar
         *      name:   aNickname
         *      major:  aMajor
         *      school:  aSchool
         *      province:  aProvince
         *      city:  aCity
         *      gender: aGender
         *      signature:  aSignature
         *      mobile: aMobile
         *      email:  aEmail
         */
//        echo \ImageStrategy::process(auth()->user()->aAvatar, 'avatar');
//        die;
//        echo auth()->user()->aAvatar . "<br />";
//        echo auth()->user()->aNickname . "<br />";
//        echo auth()->user()->aMajor . "<br />";
//        echo auth()->user()->aSchool . "<br />";
//        echo auth()->user()->aProvince . "<br />";
//        echo auth()->user()->aCity . "<br />";
//        echo auth()->user()->aGender . "<br />";
//        echo auth()->user()->aSignature . "<br />";
//        echo auth()->user()->aMobile . "<br />";
//        echo auth()->user()->aEmail . "<br />";
//        dd("----");

        return view('users.show')->with(compact('user'));
    }

    public function edit(Request $request)
    {
        // Get Params
        $nickName = $request->input('nickname', null);
        $majorId = $request->input('major', null);
        $schoolId = $request->input('school', null);
        $provinceId = $request->input('province', null);
        $cityId = $request->input('city', null);
        $gender = $request->input('gender', null);
        $signature = $request->input('signature', null);

        // Get user
        $user = Auth::user();
        empty($nickName) ?: $user->nickname = $nickName;
        empty($majorId) ?: $user->major_id = $majorId;
        empty($schoolId) ?: $user->school_id = $schoolId;
        empty($provinceId) ?: $user->province_id = $provinceId;
        empty($cityId) ?: $user->city_id = $cityId;
        !isset($gender) ?: $user->gender = $gender;
        empty($signature) ?: $user->signature = $signature;
        $user->save();

        return $this->jsonReturn(StatusCodeEnum::SUCCESS_CODE);
    }

    /**
     * 显示用户的个人中心
     * @param  Request $request 
     * @param  String  $slug    [用户个性域名]
     * @return Reponse          
     */
    public function getPrifile(Request $request, $slug)
    {
        //
    }

    /**
     * 用户个人中心的资料修改
     * @param  Request $quest
     */
    public function postProfile(Request $quest)
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * 检验用户输入的当前密码和数据库中的密码是否一致
     * @param  Request $request 
     * @return Response
     */
    public function postVerifyCurrentPassword(Request $request)
    {
        $requestPassword = $request->input('current_password');
        $databasePassword = Auth::user()->password;

        if (Hash::check($requestPassword, $databasePassword)) {
            return $this->jsonReturn(
                StatusCodeEnum::SUCCESS_CODE, 
                ['password' => '当前密码验证成功']
            );
        } 

        return $this->jsonReturn(
            StatusCodeEnum::ERROR_CODE, 
            ['password' => '输入的当前密码不正确']
        );
    }

    /**
     * 用户修改密码之更新密码
     * @param  Request $request [description]
     * @return Response
     */
    public function postUpdatePassword(Request $request)
    {
        $data['password'] = $request->input('new_password');
        $validator = Validator::make($data, [
            'password'     => 'required|min:6|max:12'
        ]);

        if ($validator->fails()) {
            return $this->jsonReturn(
                StatusCodeEnum::ERROR_CODE,
                $this->formatErrors($validator)
            );
        }

        $user = Auth::user();
        $user->password = bcrypt($data['password']);
        $user->save();

        return $this->jsonReturn(
            StatusCodeEnum::SUCCESS_CODE,
            ['password' => '密码修改成功']
        );
    }
}
