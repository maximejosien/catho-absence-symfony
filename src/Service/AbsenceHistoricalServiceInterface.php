<?php

namespace App\Service;

use App\Entity\User;

interface AbsenceHistoricalServiceInterface
{
    /**
     * @param User $user
     *
     * @return mixed
     */
    public function getAbsenceHistoricalFromUser(User $user);
}
