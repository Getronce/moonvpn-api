<?php

namespace App\Feature\User\Infrastructure\Message;

class SendWelcomeEmailMessage
{
    public function __construct(
        public readonly string $email,
    ) {
    }
}
