<?php

namespace App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\Exception;

class InsufficientFundsPurchaseSubscriptionException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Недостаточно средств для покупки подписки.');
    }
}
