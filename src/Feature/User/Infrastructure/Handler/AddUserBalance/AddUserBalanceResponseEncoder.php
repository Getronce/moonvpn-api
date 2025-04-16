<?php

namespace App\Feature\User\Infrastructure\Handler\AddUserBalance;

use App\Feature\User\Domain\Exception\UserNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AddUserBalanceResponseEncoder
{
    public function encode(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_CREATED);
    }

    public function encodeUserNotFoundException(UserNotFoundException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }
}
