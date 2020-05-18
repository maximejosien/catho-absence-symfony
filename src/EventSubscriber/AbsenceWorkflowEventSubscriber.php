<?php

namespace App\EventSubscriber;

use App\Constant\AbsenceStatesName;
use App\Entity\Absence;
use App\Service\AbsenceServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Event\EnterEvent;

class AbsenceWorkflowEventSubscriber implements EventSubscriberInterface
{
    /** @var AbsenceServiceInterface */
    private $absenceService;

    /**
     * @param AbsenceServiceInterface $absenceService
     */
    public function __construct(AbsenceServiceInterface $absenceService)
    {
        $this->absenceService = $absenceService;
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.absence_state.enter.ACCEPTED' => 'onAccepted',
            'workflow.absence_state.enter.REFUSED' => 'onRefused',
        ];
    }

    public function onAccepted(EnterEvent $event)
    {
        $absence = $event->getSubject();

        if (!$absence instanceof Absence) {
            return;
        }

        if (in_array($absence->getState(), [AbsenceStatesName::NONE, AbsenceStatesName::REFUSED])) {
            $this->absenceService->computeNumberOfHolidayWithAbsenceWhenAccepted($absence);
        }
    }

    public function onRefused(EnterEvent $event)
    {
        $absence = $event->getSubject();

        if (!$absence instanceof Absence) {
            return;
        }

        if (AbsenceStatesName::ACCEPTED === $absence->getState()) {
            $this->absenceService->computeNumberOfHolidayWithAbsenceWhenRefused($absence);
        }
    }
}
