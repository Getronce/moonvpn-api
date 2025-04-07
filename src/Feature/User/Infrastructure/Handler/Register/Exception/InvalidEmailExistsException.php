<?php

namespace App\Feature\User\Infrastructure\Handler\Register\Exception;

class InvalidEmailExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid email address');
    }
}
