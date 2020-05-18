<?php

namespace App\Service;

use App\Entity\User;

class UserService implements UserServiceInterface
{
    /**
     * @param User $user
     * @param float $nbHoliday
     */
    public function addNumberOfHoliday(User $user, float $nbHoliday): void
    {
        $user->setNumberCurrentAbsence($user->getNumberCurrentAbsence() + $nbHoliday);
    }

    /**
     * @param User $user
     * @param float $nbHoliday
     */
    public function removeNumberOfHoliday(User $user, float $nbHoliday): void
    {
        $user->setNumberCurrentAbsence($user->getNumberCurrentAbsence() - $nbHoliday);
    }
}
