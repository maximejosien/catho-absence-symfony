<?php

namespace App\Constant;

class AbsenceHalfDayName
{
    const MORNING = 'MORNING';
    const AFTERNOON = 'AFTERNOON';

    private function __construct()
    {
    }

    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    public static function getNames(): array
    {
        $class = new \ReflectionClass(self::class);

        return $class->getConstants();
    }
}
