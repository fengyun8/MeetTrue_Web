<?php

namespace App\Exceptions\SelfExceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class NoLoginException extends UnauthorizedHttpException
{
    public function __construct($message = 'Please log in first', \Exception $previous = null, $code = 0)
    {
        parent::__construct('', $message, $previous, $code);
    }
}