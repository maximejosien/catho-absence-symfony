<?php

namespace App\Service;

use App\Constant\AbsenceHalfDayName;
use App\Constant\AbsenceReasonsName;
use App\Constant\AbsenceTransitionsName;
use App\Entity\Absence;
use App\Entity\AbsenceHistorical;
use App\Repository\AbsenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Workflow\Registry;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbsenceService implements AbsenceServiceInterface
{
    /** @var TranslatorInterface */
    private $translator;

    /** @var AbsenceRepository */
    private $absenceRepository;

    /** @var Registry */
    private $workflowRegistry;

    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var Security */
    private $security;

    /**
     * @param TranslatorInterface $translator
     * @param AbsenceRepository $absenceRepository
     * @param Registry $workflowRegistry
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     */
    public function __construct(
        TranslatorInterface $translator,
        AbsenceRepository $absenceRepository,
        Registry $workflowRegistry,
        EntityManagerInterface $entityManager,
        Security $security
    ) {
        $this->translator = $translator;
        $this->absenceRepository = $absenceRepository;
        $this->workflowRegistry = $workflowRegistry;
        $this->entityManager = $entityManager;
        $this->security = $security;
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

    /**
     * @param string $absenceId
     *
     * @return bool
     */
    public function acceptAbsenceWithId(string $absenceId): bool
    {
        return $this->changeAbsenceStateWithId($absenceId, AbsenceTransitionsName::ACCEPT);
    }

    /**
     * @param string $absenceId
     *
     * @return bool
     */
    public function refuseAbsenceWithId(string $absenceId): bool
    {
        return $this->changeAbsenceStateWithId($absenceId, AbsenceTransitionsName::REFUSE);
    }

    /**
     * @param string $absenceId
     * @param string $transition
     *
     * @return bool
     */
    private function changeAbsenceStateWithId(string $absenceId, string $transition): bool
    {
        $absence = $this->absenceRepository->findOneBy([
            'id' => $absenceId
        ]);

        if (!$absence instanceof Absence) {
            return false;
        }

        $workflow = $this->workflowRegistry->get($absence);

        if ($workflow->can($absence, $transition)) {
            $workflow->apply($absence, $transition);
        }

        $user = $absence->getUser();

        if (AbsenceTransitionsName::ACCEPT === $transition) {
            $user->setNumberCurrentAbsence($user->getNumberCurrentAbsence() - 0.5);
        } elseif (AbsenceTransitionsName::REFUSE === $transition) {
            $user->setNumberCurrentAbsence($user->getNumberCurrentAbsence() + 0.5);
        }

        $absenceHistorical = new AbsenceHistorical();

        $absenceHistorical->setAbsenceState($absence->getState());
        $absenceHistorical->setAbsence($absence);
        $absenceHistorical->setRealizedBy($this->security->getUser());
        $absenceHistorical->setDate(new \DateTime('now'));

        $this->entityManager->persist($absenceHistorical);

        $this->entityManager->flush();

        return true;
    }
}
