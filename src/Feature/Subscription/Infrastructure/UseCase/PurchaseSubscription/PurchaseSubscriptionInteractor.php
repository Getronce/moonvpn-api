<?php

namespace App\Feature\Subscription\Infrastructure\UseCase\PurchaseSubscription;

use App\Feature\Subscription\Domain\Entity\Subscription;
use App\Feature\Subscription\Domain\Repository\SubscriptionRepository;
use App\Feature\Subscription\Infrastructure\Handler\PurchaseSubscription\Exception\InsufficientFundsPurchaseSubscriptionException;
use App\Feature\User\Domain\Exception\UserNotFoundException;
use App\Feature\User\Domain\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class PurchaseSubscriptionInteractor
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly SubscriptionRepository $subscriptionRepository,
        private readonly EntityManagerInterface $em,
    ) {
    }

    /**
     * @throws UserNotFoundException
     * @throws InsufficientFundsPurchaseSubscriptionException
     */
    public function __invoke(int $userId, PurchaseSubscriptionParams $params): void
    {
        $this->em->beginTransaction();

        try {
            $user = $this->userRepository->findById($userId);
            if (!$user) {
                throw new UserNotFoundException();
            }

            $currentBalance = $user->getBalance();
            if ($currentBalance < $params->amount) {
                throw new InsufficientFundsPurchaseSubscriptionException();
            }
            $user->setBalance($user->getBalance() - $params->amount);
            $this->userRepository->saveBalance($user);

            $subscription = new Subscription();
            $subscription->setUser($user);
            $subscription->setServers($params->server);
            $this->subscriptionRepository->addSubscription($subscription);

            $this->em->commit();
        } catch (\RuntimeException $e) {
            $this->em->rollback();
            throw $e;
        }
    }
}
