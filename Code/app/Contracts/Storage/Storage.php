<?php

namespace App\Contracts\Storage;

interface Storage
{
    public function set($key, $value);

    public function get($key, $default);

    public function forget($key);
}