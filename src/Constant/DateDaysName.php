<?php

namespace App\Constant;

class DateDaysName
{
    const SUNDAY = 'Sunday';

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
