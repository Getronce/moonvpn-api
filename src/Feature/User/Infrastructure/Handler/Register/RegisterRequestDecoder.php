<?php

namespace App\Feature\User\Infrastructure\Handler\Register;

use App\Feature\User\Infrastructure\Handler\Register\DTO\RegisterRequest;
use App\Feature\User\Infrastructure\UseCase\Register\RegisterParams;
use App\Shared\ValueObject\Email;

class RegisterRequestDecoder
{
    public function decode(RegisterRequest $registerRequest): RegisterParams
    {
        return new RegisterParams(
            new Email($registerRequest->email),
            $registerRequest->password
        );
    }
}
