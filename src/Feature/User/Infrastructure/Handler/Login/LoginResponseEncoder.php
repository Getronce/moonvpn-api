<?php

namespace App\Feature\User\Infrastructure\Handler\Login;

use App\Feature\User\Domain\Entity\User;
use App\Feature\User\Infrastructure\Handler\Login\Exception\InvalidCredentialsException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginResponseEncoder
{
    public function encode(User $user): JsonResponse
    {
        return new JsonResponse([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'balance' => $user->getBalance(),
        ], Response::HTTP_OK);
    }

    public function encodeInvalidCredentials(InvalidCredentialsException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_UNAUTHORIZED);
    }
}
