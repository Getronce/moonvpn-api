<?php

namespace App\Feature\User\Infrastructure\Handler\Register;

use App\Feature\User\Infrastructure\Handler\Register\Exception\InvalidEmailExistsException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterResponseEncoder
{
    public function encode(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_CREATED);
    }

    public function encodeInvalidEmailExists(InvalidEmailExistsException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }
}
