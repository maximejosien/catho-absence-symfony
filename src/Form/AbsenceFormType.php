<?php

namespace App\Form;

use App\Service\AbsenceServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AbsenceFormType extends AbstractType
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

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayAt', DateTimeType::class)
            ->add('halfDayType', ChoiceType::class, [
                'choices' => $this->absenceService->getHalfDayTypes()
            ])
            ->add('absenceReason', ChoiceType::class, [
                'choices' => $this->absenceService->getAbsenceReasons()
            ])
            ->add('save', SubmitType::class);
    }
}
