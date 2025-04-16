<?php

namespace App\Feature\Subscription\Infrastructure\UseCase\GetAllSubscriptionsUser;

use App\Feature\Subscription\Domain\Entity\Subscription;
use App\Feature\Subscription\Domain\Repository\SubscriptionRepository;

class GetAllSubscriptionsUserInteractor
{
    public function __construct(
        private readonly SubscriptionRepository $subscriptionRepository,
    ) {
    }

    /**
     * @return Subscription[]
     */
    public function __invoke(int $userId): array
    {
        return $this->subscriptionRepository->findSubscriptionByUserId($userId);
    }
}
