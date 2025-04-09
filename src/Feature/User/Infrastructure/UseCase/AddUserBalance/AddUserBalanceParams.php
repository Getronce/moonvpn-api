<?php

namespace App\Feature\User\Infrastructure\UseCase\AddUserBalance;

class AddUserBalanceParams
{
    public function __construct(
        public readonly int $amount,
    ) {
    }
}
