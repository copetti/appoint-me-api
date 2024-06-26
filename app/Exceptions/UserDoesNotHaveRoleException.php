<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class UserDoesNotHaveRoleException extends Exception
{
    use RenderToJson;

    protected $message = 'User does not have roles.';
    protected $code = 400;
}
