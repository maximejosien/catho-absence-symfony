<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
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
    private $beginAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endAt = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getBeginAt(): ?\DateTime
    {
        return $this->beginAt;
    }

    /**
     * @param \DateTime|null $beginAt
     *
     * @return $this
     */
    public function setBeginAt(?\DateTime $beginAt): self
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndAt(): ?\DateTime
    {
        return $this->endAt;
    }

    /**
     * @param \DateTime|null $endAt
     *
     * @return $this
     */
    public function setEndAt(?\DateTime $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return $this
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
