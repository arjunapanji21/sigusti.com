<?php

namespace App\Traits;

use Exception;
use App\Exceptions\PaymentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

trait HandlesErrors
{
    protected function handlePaymentError(Exception $e): RedirectResponse
    {
        Log::error('Payment Error', [
            'error' => $e->getMessage(),
            'user_id' => auth()->id(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ]);

        if ($e instanceof PaymentException) {
            $message = $e->getUserMessage();
            $type = $e->getErrorType();
        } else {
            $message = $this->getGenericErrorMessage($e);
            $type = 'error';
        }

        return redirect()->back()
            ->with($type, $message)
            ->withInput();
    }

    protected function getGenericErrorMessage(Exception $e): string
    {
        if (app()->environment('local')) {
            return "Error: " . $e->getMessage();
        }

        $errorMessages = [
            'QueryException' => 'We encountered a database error. Our team has been notified.',
            'ValidationException' => 'Please check your input and try again.',
            'TokenMismatchException' => 'Your session has expired. Please refresh the page and try again.',
            'ModelNotFoundException' => 'The requested resource was not found.',
            'AuthorizationException' => 'You are not authorized to perform this action.',
            'default' => 'An unexpected error occurred. Please try again later.'
        ];

        return $errorMessages[class_basename($e)] ?? $errorMessages['default'];
    }
}
