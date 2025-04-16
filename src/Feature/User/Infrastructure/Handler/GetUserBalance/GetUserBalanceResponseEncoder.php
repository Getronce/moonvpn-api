<?php

namespace App\Feature\User\Infrastructure\Handler\GetUserBalance;

use App\Feature\User\Domain\Entity\User;
use App\Feature\User\Domain\Exception\UserNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetUserBalanceResponseEncoder
{
    public function encode(User $user): JsonResponse
    {
        return new JsonResponse([
            'balance' => $user->getBalance(),
        ], Response::HTTP_OK);
    }

    public function encodeUserNotFoundException(UserNotFoundException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }
}
