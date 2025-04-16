<?php

namespace App\Feature\User\Infrastructure\Handler\AddUserBalance\DTO;

use Symfony\Component\Validator\Constraints\NotBlank;

class AddUserBalanceRequest
{
    public function __construct(
        #[NotBlank]
        public int $amount,
    ) {
    }
}
