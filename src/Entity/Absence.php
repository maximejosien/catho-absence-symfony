<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use MyCLabs\Enum\Enum;



/**
 * Class AbsenceType
 * @method static self CONGE_PAYE()
 * @method static self TRAVAIL()
 * @method static self FERIE()
 * @method static self MALADIE()
 * @method static self RTT() */
class AbsenceType extends Enum{

}
/**
 * @ORM\Entity
 */
class Absence
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
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime")
     */
    private $dayAt;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=180)
     */
    private $absenceReason;



    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="absences")
     */
    private $user;
    /**
     * @var AbsenceType
     *
     * @ORM\OneToOne(
     */
    private $absenceType;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getDayAt(): ?\DateTime
    {
        return $this->dayAt;
    }

    /**
     * @param \DateTime|null $dayAt
     *
     * @return $this
     */
    public function setDayAt(?\DateTime $dayAt): self
    {
        $this->dayAt = $dayAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAbsenceReason(): ?string
    {
        return $this->absenceReason;
    }

    /**
     * @param string|null $absenceReason
     *
     * @return $this
     */
    public function setAbsenceReason(?string $absenceReason): self
    {
        $this->absenceReason = $absenceReason;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return $this
     */
    public function getAbsenceType() :self{

        return $this->absenceType;

    }

    /**
     * @param AbsenceType $absenceType
     * @return $this
     */
    public function setAbsenceType(AbsenceType $absenceType) : self{

        $this->absenceType = $absenceType;

    }
}
