<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class UserAlreadyVerifiedException extends Exception
{
    use RenderToJson;

    protected $message = 'This user has already been verified.';
    protected $code = 400;
}
