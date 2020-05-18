<?php

namespace App\Service;

use App\Entity\User;

interface UserServiceInterface
{
    /**
     * @param User $user
     * @param float $nbHoliday
     */
    public function addNumberOfHoliday(User $user, float $nbHoliday): void;

    /**
     * @param User $user
     * @param float $nbHoliday
     */
    public function removeNumberOfHoliday(User $user, float $nbHoliday): void;
}
