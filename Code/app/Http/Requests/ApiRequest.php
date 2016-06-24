<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Api接口获取参数的类s
 *
 * Class ApiRequest
 * @package App\Http\Requests
 */
class ApiRequest extends Request
{
    private $data;

    public function __construct(Request $request)
    {
        // get request data
        $data = $request->input('data');
        $this->data = json_decode($data, true);
    }

    /**
     * Get value by key in 'data' part
     *
     * @param null $key
     * @param null $default
     * @return array|mixed|string
     */
    public function input($key = null, $default = null)
    {
        return Arr::get($this->data, $key, $default);
    }

    /**
     * Get all value in 'data' part
     *
     * @return array|mixed
     */
    public function all()
    {
        return $this->data;
    }
}