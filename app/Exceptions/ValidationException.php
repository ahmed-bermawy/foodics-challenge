<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct($message = 'Validation failed', $code = 422)
    {
        parent::__construct($message, $code);
    }
}