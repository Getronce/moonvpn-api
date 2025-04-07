<?php

namespace App\Feature\User\Infrastructure\Handler\Register\DTO;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterRequest
{
    public function __construct(
        #[Email]
        #[NotBlank]
        public string $email,

        #[NotBlank]
        public string $password,
    ) {
    }
}
