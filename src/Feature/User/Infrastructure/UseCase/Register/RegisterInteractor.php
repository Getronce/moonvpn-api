<?php

namespace App\Feature\User\Infrastructure\UseCase\Register;

use App\Feature\User\Domain\Entity\User;
use App\Feature\User\Domain\Repository\UserRepository;
use App\Feature\User\Infrastructure\Handler\Register\Exception\InvalidEmailExistsException;
use App\Feature\User\Infrastructure\Message\SendWelcomeEmailMessage;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterInteractor
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $userRepository,
        private readonly MessageBusInterface $bus,
    ) {
    }

    /**
     * @throws InvalidEmailExistsException
     * @throws ExceptionInterface
     */
    public function __invoke(RegisterParams $params): void
    {
        $user = $this->userRepository->findByEmail($params->email);

        if (null !== $user) {
            throw new InvalidEmailExistsException();
        }

        $user = new User();
        $user->setEmail($params->email);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $params->password);

        $user->setPassword($hashedPassword);

        $this->userRepository->save($user);

        $this->bus->dispatch(new SendWelcomeEmailMessage($params->email));
    }
}
