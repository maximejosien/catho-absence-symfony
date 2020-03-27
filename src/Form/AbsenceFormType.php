<?php

namespace App\Form;

use App\Service\AbsenceServiceInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AbsenceFormType extends AbstractType
{
    const ABSENCE = 'absence';
    const DATE_FORM = 'DATE_FORM';
    const HALF_DAY_TYPE_FORM = 'HALF_DAY_TYPE_FORM';
    const ABSENCE_REASON_FORM = 'ABSENCE_REASON_FORM';
    const SAVE_FORM = 'SAVE_FORM';

    /** @var AbsenceServiceInterface */
    private $absenceService;

    /** @var TranslatorInterface */
    private $translator;

    /**
     * @param AbsenceServiceInterface $absenceService
     * @param TranslatorInterface $translator
     */
    public function __construct(AbsenceServiceInterface $absenceService, TranslatorInterface $translator)
    {
        $this->absenceService = $absenceService;
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayAt', DateTimeType::class, [
                'label' => $this->translator->trans(self::DATE_FORM, [], self::ABSENCE),
            ])
            ->add('halfDayType', ChoiceType::class, [
                'label' => $this->translator->trans(self::HALF_DAY_TYPE_FORM, [], self::ABSENCE),
                'choices' => $this->absenceService->getHalfDayTypes(),
            ])
            ->add('absenceReason', ChoiceType::class, [
                'label' => $this->translator->trans(self::ABSENCE_REASON_FORM, [], self::ABSENCE),
                'choices' => $this->absenceService->getAbsenceReasons(),
            ])
            ->add('save', SubmitType::class, [
                'label' => $this->translator->trans(self::SAVE_FORM, [], self::ABSENCE),
            ]);
    }
}
