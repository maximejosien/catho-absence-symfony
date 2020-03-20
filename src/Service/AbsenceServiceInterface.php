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
}
