<?php

namespace App\Feature\Subscription\Infrastructure\UseCase\PurchaseSubscription;

class PurchaseSubscriptionParams
{
    public function __construct(
        public readonly int $amount,
        public readonly string $server,
    ) {
    }
}
