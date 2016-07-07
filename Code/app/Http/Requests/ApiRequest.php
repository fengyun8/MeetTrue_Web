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

    protected $injected_parameters = [];

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
        // if(!empty($this->injected_parameters)) {
        //     $this->data += $this->injected_parameters;
        // }

        return Arr::get($this->data, $key, $default);
    }

    /**
     * Get all value in 'data' part
     *
     * @return array|mixed
     */
    public function all()
    {
        if(!empty($this->injected_parameters)) {
            $this->data += $this->injected_parameters;
        }
       return $this->data;
    }

    /**
     * 将健值插入到ApiRequest的$injected_parameters属性中
     * 如果值是数组，需要传一个参数，如$request->inject($data); 
     * 会将$data数组的健值对应放进$injected_parameters属性中
     * 如果是健值对，传两个参数，$key和$value
     * 
     * @param  String or Array $key  
     * @param  mixed $value 
     * @return ApiRequest Object
     */
    public function inject($key, $value = null)
    {
        if(is_array($key)) {
            foreach($key as $k => $v) {
                $this->inject($k, $v);
            }
        } else {
            $this->injected_parameters[$key] = $value;
        }
        return $this;
    }
}