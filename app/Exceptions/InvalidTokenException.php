<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class InvalidTokenException extends Exception
{
    use RenderToJson;

    protected $message = 'This token is not valid.';
    protected $code = 400;
}
