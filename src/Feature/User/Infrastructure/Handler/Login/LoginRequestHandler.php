<?php

namespace App\Feature\User\Infrastructure\Handler\Login;

use App\Feature\User\Infrastructure\Handler\Login\DTO\LoginRequest;
use App\Feature\User\Infrastructure\Handler\Login\Exception\InvalidCredentialsException;
use App\Feature\User\Infrastructure\UseCase\Login\LoginInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class LoginRequestHandler extends AbstractController
{
    public function __construct(
        private readonly LoginRequestDecoder $loginRequestDecoder,
        private readonly LoginInteractor $loginInteractor,
        private readonly LoginResponseEncoder $loginResponseEncoder,
    ) {
    }

    #[Route('api/login', methods: 'POST', format: 'json')]
    public function index(#[MapRequestPayload] LoginRequest $request): JsonResponse
    {
        $params = $this->loginRequestDecoder->decode($request);

        try {
            $user = $this->loginInteractor->__invoke($params);
        } catch (InvalidCredentialsException $e) {
            return $this->loginResponseEncoder->encodeInvalidCredentials($e);
        }

        return $this->loginResponseEncoder->encode($user);
    }
}
