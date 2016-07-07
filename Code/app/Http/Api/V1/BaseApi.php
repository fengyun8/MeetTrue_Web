<?php

namespace App\Http\Api\V1;


use App\Utils\ReturnTrait;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Enums\StatusCodeEnum;
use App\Utils\ValidateTrait;

class BaseApi
{
    use ValidatesRequests, ReturnTrait, ValidateTrait;

    protected function throwValidationException(Request $request, $validator)
    {
        throw new ValidationException($validator);
    }
}