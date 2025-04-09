<?php

namespace App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription;

use App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\Exception\InsufficientFundsPurchaseSubscriptionException;
use App\Feature\User\Domain\Exception\UserNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PurchaseSubscriptionResponseEncoder
{
    public function encode(): JsonResponse
    {
        return new JsonResponse([], Response::HTTP_OK);
    }

    public function encodeUserNotFoundException(UserNotFoundException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }

    public function encodeInsufficientFundsPurchaseSubscriptionException(InsufficientFundsPurchaseSubscriptionException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
