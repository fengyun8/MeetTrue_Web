<?php
namespace App\Utils;

use App\Exceptions\SelfExceptions\ValidatorApiException;
use Illuminate\Http\Request;
use Validator;

/**
 * Validate Trait
 */
trait ValidateTrait
{
    /**
     * Validate For Api
     * @param $request
     * @param $rules
     * @param null $errorMessages
     * @throws ValidatorApiException
     */
    public function validateForApi($request, $rules, $errorMessages = null)
    {
        // request convert to array
        if ($request instanceof Request) {
            $request = $request->all();
        }

        // validator
        $validator = Validator::make($request, $rules);
        if ($validator->fails()) {
            // no self errorMessages
            if ($errorMessages == null) {
                throw new ValidatorApiException($validator->errors()->getMessages());
            }
            throw new ValidatorApiException($errorMessages);
        }
    }
}