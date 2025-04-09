<?php

namespace App\Feature\User\Infrastructure\UseCase\AddUserBalance;

use App\Feature\User\Domain\Exception\UserNotFoundException;
use App\Feature\User\Domain\Repository\UserRepository;

class AddUserBalanceInteractor
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(int $userId, AddUserBalanceParams $params): void
    {
        $user = $this->userRepository->findById($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $newBalance = $user->getBalance() + $params->amount;
        $user->setBalance($newBalance);

        $this->userRepository->saveBalance($user);
    }
}
