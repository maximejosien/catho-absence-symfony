<?php

namespace App\Service;

interface CalendarServiceInterface
{
    /**
     * @param \DateTime $dateMonth
     */
    public function computeCalendarOnMonth(\DateTime $dateMonth): array;

    /**
     * @param \DateTime $date
     *
     * @return string
     */
    public function getDateWithMonthAndYear(\DateTime $date): string;
}
