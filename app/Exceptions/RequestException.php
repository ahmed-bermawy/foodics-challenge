<?php

namespace App\Exceptions;

use Exception;

class RequestException extends Exception
{
    public function __construct($message = 'Request failed', $code = 500)
    {
        parent::__construct($message, $code);
    }

}