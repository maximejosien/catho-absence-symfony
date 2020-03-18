<?php

namespace App\Repository;

use App\Entity\Absence;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AbsenceRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Absence::class);
    }

    public function getAbsenceByUserAndDate(User $user, \DateTime $date)
    {
        $queryBuilder = $this->createQueryBuilder('a');

        return $queryBuilder
            ->leftJoin('a.user', 'u')
            ->andWhere($queryBuilder->expr()->eq('u.id', ':userId'))
            ->andWhere($queryBuilder->expr()->eq('a.dayAt', ':date'))
            ->setParameters([
                'userId' => $user->getId(),
                'date' => $date,
            ])
            ->getQuery()
            ->getResult();
    }
}
