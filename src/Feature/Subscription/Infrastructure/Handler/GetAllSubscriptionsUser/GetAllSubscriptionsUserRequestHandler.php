<?php

namespace App\Feature\Subscription\Infrastructure\Handler\GetAllSubscriptionsUser;

use App\Feature\Subscription\Infrastructure\UseCase\GetAllSubscriptionsUser\GetAllSubscriptionsUserInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class GetAllSubscriptionsUserRequestHandler extends AbstractController
{
    public function __construct(
        private readonly GetAllSubscriptionsUserInteractor $getAllSubscriptionsUserInteractor,
        private readonly GetAllSubscriptionsUserResponseEncoder $getAllSubscriptionsUserResponseEncoder,
    ) {
    }

    #[Route('api/user/{id}/subscriptions', methods: 'GET', format: 'json')]
    public function index(int $id): JsonResponse
    {
        try {
            $subscriptions = $this->getAllSubscriptionsUserInteractor->__invoke($id);

            return $this->getAllSubscriptionsUserResponseEncoder->encode($subscriptions);
        } catch (\RuntimeException $e) {
            return $this->getAllSubscriptionsUserResponseEncoder->encodeNoSubscriptionFoundUserException($e);
        }
    }
}
