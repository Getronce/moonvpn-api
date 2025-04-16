<?php

namespace App\Feature\User\Domain\Exception;

class UserNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Пользователь не найден');
    }
}
