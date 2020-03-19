<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbsenceRepository")
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
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="absences")
     */
    private $user;

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
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     *
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
