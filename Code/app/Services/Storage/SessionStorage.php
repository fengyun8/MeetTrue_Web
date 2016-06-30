<?php

namespace App\Services\Storage;

use App\Contracts\Storage\Storage;

class SessionStorage implements Storage
{
    public function set($key, $value)
    {
        session([
            $key => $value,
        ]);
    }

    public function get($key, $default)
    {
        return session($key, $default);
    }

    public function forget($key)
    {
        session()->forget($key);
    }
}
