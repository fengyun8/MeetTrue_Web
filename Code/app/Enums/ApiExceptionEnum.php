<?php

namespace App\Enums;

class ApiExceptionEnum
{
    const SYSTEM_SIGN_ERROR = 'system::sign_error';
    const SYSTEM_API_NOT_EXISTS = 'system::api_not_exists';
    const SYSTEM_DATA_VALIDATOR_FAIL = 'system::data_validator_fail';
    const SYSTEM_DEVICE_NOT_EXIST = 'system::device_not_exist';
    const SYSTEM_APPKEY_ERROR = 'system::appkey_error';
    const SYSTEM_EXPIRED_ERROR = 'system::expired_error';
}