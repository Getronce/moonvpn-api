<?php

namespace App\Feature\User\Infrastructure\UseCase\GetUserBalance;

use App\Feature\User\Domain\Entity\User;
use App\Feature\User\Domain\Exception\UserNotFoundException;
use App\Feature\User\Domain\Repository\UserRepository;

class GetUserBalanceInteractor
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    /**
     * @throws UserNotFoundException
     */
    public function __invoke(int $id): User
    {
        $user = $this->userRepository->find($id);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
