<?php

namespace App\Services\JsonRpc;

use App\Exceptions\JsonRpcException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Class JsonRpcServer
 * @package App\Services\JsonRpc
 */
class JsonRpcServer
{
    /**
     * @param Request $request
     * @param Controller $controller
     * @return JsonRpcResponse
     */
    public function handle(Request $request, Controller $controller): JsonRpcResponse
    {
        try {
            $content = json_decode($request->getContent(), true);
            if (empty($content)) {
                throw new JsonRpcException(JsonRpcException::CODE_PARSE_ERROR);
            }

            $result = $controller->{$content['method']}(...[$content['params']]);

            return JsonRpcResponse::success($result, $request->id);
        } catch (\Exception $e) {
            return JsonRpcResponse::error($e->getMessage(), $request->id);
        }
    }
}
