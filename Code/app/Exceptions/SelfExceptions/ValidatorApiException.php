<?php
namespace App\Exceptions\SelfExceptions;

use Exception;

/**
 * 自定义 Validator Api Exception
 *
 * @package App\Exceptions\SelfExceptions
 */
class ValidatorApiException extends Exception
{
    public $errorMessage;

    public function __construct(Array $errorMessage, \Exception $previous = null, $code = 0)
    {
        $this->errorMessage = $errorMessage;
        parent::__construct('no message', $code, $previous);
    }
}