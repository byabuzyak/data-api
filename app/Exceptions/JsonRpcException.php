<?php

namespace App\Exceptions;

use Throwable;

/**
 * Class JsonRpcException
 * @package App\Exceptions
 */
class JsonRpcException extends \Exception
{
    public const CODE_PARSE_ERROR = -32700;
    public const CODE_INVALID_REQUEST = -32600;
    public const CODE_METHOD_NOT_FOUND = -32601;
    public const CODE_INVALID_PARAMS = -32602;
    public const CODE_INTERNAL_ERROR = -32603;
    public const CODE_SERVER_ERROR = -32000;

    /**
     * @var string[]
     */
    public $messages = [
        self::CODE_PARSE_ERROR      => 'Parse error',
        self::CODE_INVALID_REQUEST  => 'Invalid Request',
        self::CODE_METHOD_NOT_FOUND => 'Method not found',
        self::CODE_INVALID_PARAMS   => 'Invalid params',
        self::CODE_INTERNAL_ERROR   => 'Internal error',
        self::CODE_SERVER_ERROR     => 'Server error',
    ];

    protected $data;

    /**
     * JsonRpcException constructor.
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        $message = null;
        if (isset($this->messages[$code])) {
            $message = $this->messages[$code];
        }

        parent::__construct($message, $code, $previous);
    }
}
