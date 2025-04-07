<?php

namespace App\Feature\User\Infrastructure\UseCase\Login;

use App\Feature\User\Domain\Entity\User;
use App\Feature\User\Domain\Repository\UserRepository;
use App\Feature\User\Infrastructure\Handler\Login\Exception\InvalidCredentialsException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginInteractor
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository $userRepository,
    ) {
    }

    /**
     * @throws InvalidCredentialsException
     */
    public function __invoke(LoginParams $params): User
    {
        $user = $this->userRepository->findByEmail($params->email);

        if (!$user || !$this->passwordHasher->isPasswordValid($user, $params->password)) {
            throw new InvalidCredentialsException();
        }

        return $user;
    }
}
