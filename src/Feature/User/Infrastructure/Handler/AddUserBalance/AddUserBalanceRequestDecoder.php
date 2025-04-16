<?php

namespace App\Feature\User\Infrastructure\Handler\AddUserBalance;

use App\Feature\User\Infrastructure\Handler\AddUserBalance\DTO\AddUserBalanceRequest;
use App\Feature\User\Infrastructure\UseCase\AddUserBalance\AddUserBalanceParams;

class AddUserBalanceRequestDecoder
{
    public function decode(AddUserBalanceRequest $topUpUserBalanceRequest): AddUserBalanceParams
    {
        return new AddUserBalanceParams(
            $topUpUserBalanceRequest->amount,
        );
    }
}
