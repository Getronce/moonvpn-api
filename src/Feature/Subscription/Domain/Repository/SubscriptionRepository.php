<?php

namespace App\Feature\Subscription\Domain\Repository;

use App\Feature\Subscription\Domain\Entity\Subscription;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subscription>
 */
class SubscriptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscription::class);
    }

    public function addSubscription(Subscription $subscription): void
    {
        $this->getEntityManager()->persist($subscription);
        $this->getEntityManager()->flush();
    }

    /**
     * @return Subscription[]
     */
    public function findSubscriptionByUserId(int $userId): array
    {
        return $this->findBy(['user' => $userId]);
    }
}
