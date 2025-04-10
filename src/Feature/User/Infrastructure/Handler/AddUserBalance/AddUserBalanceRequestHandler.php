<?php

namespace App\Feature\User\Infrastructure\Handler\AddUserBalance;

use App\Feature\User\Domain\Exception\UserNotFoundException;
use App\Feature\User\Infrastructure\Handler\AddUserBalance\DTO\AddUserBalanceRequest;
use App\Feature\User\Infrastructure\UseCase\AddUserBalance\AddUserBalanceInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AddUserBalanceRequestHandler extends AbstractController
{
    public function __construct(
        private readonly AddUserBalanceRequestDecoder $addUserBalanceDecoder,
        private readonly AddUserBalanceInteractor $addUserBalanceInteractor,
        private readonly AddUserBalanceResponseEncoder $addUserBalanceEncoder,
    ) {
    }

    #[Route('api/user/{id}/balance/add', methods: 'POST', format: 'json')]
    public function index(int $id, #[MapRequestPayload] AddUserBalanceRequest $request): JsonResponse
    {
        $params = $this->addUserBalanceDecoder->decode($request);

        try {
            $this->addUserBalanceInteractor->__invoke($id, $params);
        } catch (UserNotFoundException $e) {
            return $this->addUserBalanceEncoder->encodeUserNotFoundException($e);
        }

        return $this->addUserBalanceEncoder->encode();
    }
}
