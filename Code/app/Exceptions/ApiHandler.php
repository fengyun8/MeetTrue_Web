<?php

namespace App\Exceptions;

use App\Utils\ReturnTrait;
use Config;
use Exception;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiHandler extends ExceptionHandler
{
    use ReturnTrait;

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        $code = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
        $message = $e->getMessage();
        $data = null;

        // debug 模式
        if (Config::get('app.debug')) {
            $data['debug'] = [
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'class' => get_class($e),
                'trace' => explode("\n", $e->getTraceAsString()),
            ];
        }

        return $this->jsonReturn($code, $message, $data);
    }

}