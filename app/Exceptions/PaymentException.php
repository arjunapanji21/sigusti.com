<?php

namespace App\Exceptions;

use Exception;

class PaymentException extends Exception
{
    protected $userMessage;
    protected $errorType;

    public function __construct(string $message = "", string $userMessage = "", string $errorType = "payment_error", int $code = 0, ?Throwable $previous = null)
    {
        $this->userMessage = $userMessage ?: $message;
        $this->errorType = $errorType;
        parent::__construct($message, $code, $previous);
    }

    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    public function getErrorType(): string
    {
        return $this->errorType;
    }
}
