<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class TeamDoesNotExistException extends Exception
{
    use RenderToJson;

    protected $message = 'Team does not exist.';
    protected $code = 400;
}
