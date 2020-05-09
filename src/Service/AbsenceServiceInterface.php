<?php

namespace App\Service;

use App\Constant\AbsenceHalfDayName;

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
}
