<?php

namespace App\Feature\User\Infrastructure\UseCase\Register;

class RegisterParams
{
    public function __construct(
        public string $email,
        public string $password,
    ) {
    }
}
