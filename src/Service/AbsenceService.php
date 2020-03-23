<?php

namespace App\Service;

use App\Constant\AbsenceHalfDayName;
use App\Constant\AbsenceReasonsName;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbsenceService implements AbsenceServiceInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    public function getHalfDayTypes(): array
    {
        $halfDayTypes = AbsenceHalfDayName::getNames();

        $choices = [];

        foreach ($halfDayTypes as $type) {
            $choices[$this->translator->trans($type, [], 'date')] = $type;
        }

        return $choices;
    }

    /**
     * @return array
     *
     * @throws \ReflectionException
     */
    public function getAbsenceReasons(): array
    {
        $absenceReasons = AbsenceReasonsName::getNames();

        $choices = [];

        foreach ($absenceReasons as $reason) {
            $choices[$this->translator->trans($reason, [], 'absence')] = $reason;
        }

        return $choices;
    }
}
