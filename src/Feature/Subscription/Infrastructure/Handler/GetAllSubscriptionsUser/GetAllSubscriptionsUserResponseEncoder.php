<?php

namespace App\Feature\Subscription\Infrastructure\Handler\GetAllSubscriptionsUser;

use App\Feature\Subscription\Domain\Entity\Subscription;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetAllSubscriptionsUserResponseEncoder
{
    /**
     * @param Subscription[]
     */
    public function encode(array $subscriptions): JsonResponse
    {
        $data = array_map(fn ($subscription) => [
            'servers' => $subscription->getServers(),
        ], $subscriptions);

        return new JsonResponse($data, Response::HTTP_OK);
    }

    public function encodeNoSubscriptionFoundUserException(\RuntimeException $exception): JsonResponse
    {
        return new JsonResponse(['error' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }
}
