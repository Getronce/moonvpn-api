<?php

namespace App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription;

use App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\DTO\PurchaseSubscriptionRequest;
use App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\Exception\InsufficientFundsPurchaseSubscriptionException;
use App\Feature\Subscription\Infrastructure\UseCase\PurchaseSubscription\PurchaseSubscriptionInteractor;
use App\Feature\User\Domain\Exception\UserNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PurchaseSubscriptionRequestHandler extends AbstractController
{
    public function __construct(
        private readonly PurchaseSubscriptionRequestDecoder $purchaseSubscriptionDecoder,
        private readonly PurchaseSubscriptionInteractor $purchaseSubscriptionInteractor,
        private readonly PurchaseSubscriptionResponseEncoder $purchaseSubscriptionEndcoder,
    ) {
    }

    #[Route('api/user/{id}/subscription/purchase', methods: 'POST', format: 'json')]
    public function index(int $id, #[MapRequestPayload] PurchaseSubscriptionRequest $request): JsonResponse
    {
        $params = $this->purchaseSubscriptionDecoder->decode($request);

        try {
            $this->purchaseSubscriptionInteractor->__invoke($id, $params);
        } catch (UserNotFoundException $e) {
            return $this->purchaseSubscriptionEndcoder->encodeUserNotFoundException($e);
        } catch (InsufficientFundsPurchaseSubscriptionException $e) {
            return $this->purchaseSubscriptionEndcoder->encodeInsufficientFundsPurchaseSubscriptionException($e);
        }

        return $this->purchaseSubscriptionEndcoder->encode();
    }
}
