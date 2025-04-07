<?php

namespace App\Feature\User\Infrastructure\UseCase\Login;

class LoginParams
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
