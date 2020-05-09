<?php

namespace App\Constant;

class AbsenceTransitionsName
{
    const ACCEPT = 'accept';
    const REFUSE = 'refuse';

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
