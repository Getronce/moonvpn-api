<?php

namespace App\Feature\User\Infrastructure\Handler\GetUserBalance;

use App\Feature\User\Domain\Exception\UserNotFoundException;
use App\Feature\User\Infrastructure\UseCase\GetUserBalance\GetUserBalanceInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GetUserBalanceRequestHandler extends AbstractController
{
    public function __construct(
        private readonly GetUserBalanceInteractor $getUserBalanceInteractor,
        private readonly GetUserBalanceResponseEncoder $getUserBalanceResponseEncoder,
    ) {
    }

    #[Route('api/user/{id}/balance', methods: 'GET', format: 'json')]
    public function index(int $id): JsonResponse
    {
        try {
            $user = $this->getUserBalanceInteractor->__invoke($id);
        } catch (UserNotFoundException $e) {
            return $this->getUserBalanceResponseEncoder->encodeUserNotFoundException($e);
        }

        return $this->getUserBalanceResponseEncoder->encode($user);
    }
}
