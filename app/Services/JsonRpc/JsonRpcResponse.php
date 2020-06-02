<?php

namespace App\Services\JsonRpc;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class JsonRpcResponse
 * @package App\Services\JsonRpc
 */
class JsonRpcResponse implements Jsonable, Arrayable
{
    public $version = '2.0';
    public $error = null;
    public $result = null;
    public $id = null;

    /**
     * @param $result
     * @param string|null $id
     * @return JsonRpcResponse
     */
    public static function success(JsonResource $result, string $id = null)
    {
        $response         = new self();
        $response->result = $result;
        $response->id     = $id;

        return $response;
    }

    /**
     * @param $error
     * @param string|null $id
     * @return JsonRpcResponse
     */
    public static function error(string $error, string $id = null)
    {
        $response        = new self();
        $response->error = $error;
        $response->id    = $id;

        return $response;
    }

    /**
     * @return array|string[]
     */
    public function toArray()
    {
        $response = [
            'jsonrpc' => $this->version
        ];

        if (null !== $this->id) {
            $response['id'] = $this->id;
        }

        if (null !== $this->error) {
            $response['error'] = $this->error;
        } else {
            $response['result'] = $this->result;
        }

        return $response;
    }

    /**
     * @param int $options
     * @return false|string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options | JSON_UNESCAPED_UNICODE);
    }
}
