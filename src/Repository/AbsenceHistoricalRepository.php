<?php

namespace App\Repository;

use App\Entity\AbsenceHistorical;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AbsenceHistoricalRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbsenceHistorical::class);
    }

    /**
     * @param User $user
     *
     * @return int|mixed|string
     */
    public function getAbsencesHistoricalByUser(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('ah');

        return $queryBuilder
            ->leftJoin('ah.absence', 'a')
            ->andWhere($queryBuilder->expr()->eq('a.user', ':user'))
            ->setParameters([
                'user' => $user,
            ])
            ->orderBy('ah.id', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
