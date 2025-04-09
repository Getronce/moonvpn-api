<?php

namespace App\Feature\Subscription\Infrastructure\Handler\GetAllSubscriptionsUser\Exception;

class NoSubscriptionsFoundForUserException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Подписки не найдены для данного пользователя');
    }
}
