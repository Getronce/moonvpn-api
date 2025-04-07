<?php

namespace App\Feature\User\Infrastructure\Handler\Register;

use App\Feature\User\Infrastructure\Handler\Register\DTO\RegisterRequest;
use App\Feature\User\Infrastructure\Handler\Register\Exception\InvalidEmailExistsException;
use App\Feature\User\Infrastructure\UseCase\Register\RegisterInteractor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class RegisterRequestHandler extends AbstractController
{
    public function __construct(
        private readonly RegisterRequestDecoder $registerRequestDecoder,
        private readonly RegisterInteractor $registerInteractor,
        private readonly RegisterResponseEncoder $registerResponseEncoder,
    ) {
    }

    #[Route('api/register', methods: 'POST', format: 'json')]
    public function index(#[MapRequestPayload] RegisterRequest $request): JsonResponse
    {
        $params = $this->registerRequestDecoder->decode($request);

        try {
            $this->registerInteractor->__invoke($params);
        } catch (InvalidEmailExistsException $e) {
            return $this->registerResponseEncoder->encodeInvalidEmailExists($e);
        }

        return $this->registerResponseEncoder->encode();
    }
}
