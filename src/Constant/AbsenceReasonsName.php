<?php

namespace App\Constant;

class AbsenceReasonsName
{
    const PAID_LEAVE = 'PAID_LEAVE';
    const SICK_LEAVE = 'SICK_LEAVE';
    const RTT_LEAVE = 'RTT_LEAVE';
    const UNPAID_LEAVE = 'UNPAID_LEAVE';

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
