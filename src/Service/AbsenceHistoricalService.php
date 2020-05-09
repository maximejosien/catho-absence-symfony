<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\AbsenceHistoricalRepository;

class AbsenceHistoricalService implements AbsenceHistoricalServiceInterface
{
    /** @var AbsenceHistoricalRepository */
    private $absenceHistoricalRepository;

    /**
     * @param AbsenceHistoricalRepository $absenceHistoricalRepository
     */
    public function __construct(AbsenceHistoricalRepository $absenceHistoricalRepository)
    {
        $this->absenceHistoricalRepository = $absenceHistoricalRepository;
    }

    /**
     * @param User $user
     *
     * @return int|mixed|string
     */
    public function getAbsenceHistoricalFromUser(User $user)
    {
        return $this->absenceHistoricalRepository->getAbsencesHistoricalByUser($user);
    }
}
