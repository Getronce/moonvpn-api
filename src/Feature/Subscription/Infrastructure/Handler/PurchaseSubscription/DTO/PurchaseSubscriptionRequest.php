<?php

namespace App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\DTO;

use Symfony\Component\Validator\Constraints\NotBlank;

class PurchaseSubscriptionRequest
{
    public function __construct(
        #[NotBlank]
        public int $amount,
        #[NotBlank]
        public string $server,
    ) {
    }
}
