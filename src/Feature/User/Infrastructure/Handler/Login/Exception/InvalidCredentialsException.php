<?php

namespace App\Feature\User\Infrastructure\Handler\Login\Exception;

class InvalidCredentialsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Неверные учетные данные');
    }
}
