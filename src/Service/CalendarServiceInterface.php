<?php

namespace App\Service;

use App\Entity\User;

interface CalendarServiceInterface
{
    /**
     * @param \DateTime $dateMonth
     * @param User $user
     *
     * @return array
     */
    public function computeCalendarOnMonth(\DateTime $dateMonth, User $user): array;

    /**
     * @param \DateTime $date
     *
     * @return string
     */
    public function getDateWithMonthAndYear(\DateTime $date): string;
}
