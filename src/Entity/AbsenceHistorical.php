<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class AbsenceHistorical
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $absenceState;

    /**
     * @var Absence
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Absence")
     */
    private $absence;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $realizedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAbsenceState(): string
    {
        return $this->absenceState;
    }

    /**
     * @param string $absenceState
     *
     * @return $this
     */
    public function setAbsenceState(string $absenceState): self
    {
        $this->absenceState = $absenceState;

        return $this;
    }

    /**
     * @return Absence
     */
    public function getAbsence(): Absence
    {
        return $this->absence;
    }

    /**
     * @param Absence $absence
     *
     * @return $this
     */
    public function setAbsence(Absence $absence): self
    {
        $this->absence = $absence;

        return $this;
    }

    /**
     * @return User
     */
    public function getRealizedBy(): User
    {
        return $this->realizedBy;
    }

    /**
     * @param User $realizedBy
     *
     * @return $this
     */
    public function setRealizedBy(User $realizedBy): self
    {
        $this->realizedBy = $realizedBy;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }
}
