<?php

namespace App\Feature\User\Infrastructure\MessageHandler;

use App\Feature\User\Infrastructure\Message\SendWelcomeEmailMessage;
use App\Feature\User\Infrastructure\Service\EmailTemplateService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class SendWelcomeEmailMessageHandler
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly EmailTemplateService $emailTemplateService,
    ) {
    }

    public function __invoke(SendWelcomeEmailMessage $message): void
    {
        $emailContent = $this->emailTemplateService->generateWelcomeEmailContent($message->email);

        $email = (new Email())
            ->from('aia2333@mail.ru')
            ->to($message->email)
            ->subject('Добро пожаловать!')
            ->html($emailContent);

        $this->mailer->send($email);
    }
}
