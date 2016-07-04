<?php

namespace App\Enums;


class OperateLogTypeEnum
{
    const UNKNOWN=0;                     // 未知
    const LOGIN=1;                       // 登陆
    const LOGOUT=2;                     // 退出
    const RESET_PASSWORD_BY_EMAIL=3;                     // 邮箱找回密码
    const RESET_PASSWORD_BY_MOBILE=4;                   // 手机找回密码
}