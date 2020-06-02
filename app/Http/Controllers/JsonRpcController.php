<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonRpcException;
use Illuminate\Support\Facades\Validator;

trait JsonRpcController
{
    /**
     * @param array $data
     * @param array $rules
     * @throws JsonRpcException
     */
    public function validateData(array $data, array $rules)
    {
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new JsonRpcException(JsonRpcException::CODE_INVALID_PARAMS);
        }
    }
}
