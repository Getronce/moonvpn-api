<?php

namespace App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription;

use App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\DTO\PurchaseSubscriptionRequest;
use App\Feature\Subscription\Infrastructure\UseCase\PurchaseSubscription\PurchaseSubscriptionParams;

class PurchaseSubscriptionRequestDecoder
{
    public function decode(PurchaseSubscriptionRequest $purchaseSubscriptionRequest): PurchaseSubscriptionParams
    {
        return new PurchaseSubscriptionParams(
            $purchaseSubscriptionRequest->amount,
            $purchaseSubscriptionRequest->server
        );
    }
}
