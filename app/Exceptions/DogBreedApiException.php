<?php

namespace App\Exceptions;

use Exception;

class DogBreedApiException extends Exception
{
    public function __construct(string $message = "Dog API error", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
