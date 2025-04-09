<?php

namespace App\Feature\Subscription\Infrastructure\UseCase\GetAllSubscriptionsUser;

use App\Feature\Subscription\Domain\Entity\Subscription;
use App\Feature\Subscription\Domain\Repository\SubscriptionRepository;
use App\Feature\Subscription\Infrastructure\Handler\GetAllSubscriptionsUser\Exception\NoSubscriptionsFoundForUserException;

class GetAllSubscriptionsUserInteractor
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
    ) {
    }

    /**
     * @return Subscription[]
     *
     * @throws NoSubscriptionsFoundForUserException
     */
    public function __invoke(int $userId): array
    {
        $subscription = $this->subscriptionRepository->findSubscriptionByUserId($userId);
        if (null === $subscription) {
            throw new NoSubscriptionsFoundForUserException();
        }

        return $subscription;
    }
}
