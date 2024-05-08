<?php

namespace App\Exceptions;

use App\Traits\RenderToJson;
use Exception;

class MissingTeamException extends Exception
{
    use RenderToJson;

    protected $message = 'Missing Team.';
    protected $code = 400;
}
