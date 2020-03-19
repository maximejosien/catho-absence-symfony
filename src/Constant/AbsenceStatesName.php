<?php

namespace App\Constant;

class AbsenceStatesName
{
    const NONE = 'NONE';
    const ACCEPTED = 'ACCEPTED';
    const REFUSED = 'REFUSED';

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
