<?php

namespace App\Feature\User\Infrastructure\Handler\Login;

use App\Feature\User\Infrastructure\Handler\Login\DTO\LoginRequest;
use App\Feature\User\Infrastructure\UseCase\Login\LoginParams;
use App\Shared\ValueObject\Email;

class LoginRequestDecoder
{
    public function decode(LoginRequest $loginRequest): LoginParams
    {
        return new LoginParams(
            new Email($loginRequest->email),
            $loginRequest->password
        );
    }
}
