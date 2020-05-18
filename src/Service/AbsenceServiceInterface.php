<?php

namespace App\Service;

use App\Entity\Absence;

interface AbsenceServiceInterface
{
    /**
     * @return array
     */
    public function getHalfDayTypes(): array;

    /**
     * @return array
     */
    public function getAbsenceReasons(): array;

    /**
     * @param string $absenceId
     *
     * @return bool
     */
    public function acceptAbsenceWithId(string $absenceId): bool;

    /**
     * @param string $absenceId
     *
     * @return bool
     */
    public function refuseAbsenceWithId(string $absenceId): bool;

    /**
     * @param Absence $absence
     */
    public function computeNumberOfHolidayWithAbsenceWhenAccepted(Absence $absence): void;

    /**
     * @param Absence $absence
     */
    public function computeNumberOfHolidayWithAbsenceWhenRefused(Absence $absence): void;
}
