<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 *
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
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
     * @var string|null
     *
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @var array
     *
     * @ORM\Column(type="json")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var Collection|Absence[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Absence", mappedBy="user")
     */
    private $absences;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private $lastName;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $numberCurrentAbsence = 25;

    public function __construct()
    {
        $this->absences = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|void|null
     */
    public function getSalt()
    {
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Absence[]|Collection
     */
    public function getAbsences()
    {
        return $this->absences;
    }

    /**
     * @param $absences
     *
     * @return $this
     */
    public function setAbsences($absences): self
    {
        $this->absences = $absences;

        return $this;
    }

    /**
     * @param Absence $absence
     *
     * @return $this
     */
    public function addAbsence(Absence $absence): self
    {
        if (!$this->absences->contains($absence)) {
            $this->absences[] = $absence;
            $absence->setUser($this);
        }

        return $this;
    }

    /**
     * @param Absence $absence
     *
     * @return $this
     */
    public function removeAbsence(Absence $absence): self
    {
        $this->removeAbsence($absence);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string|null $firstName
     *
     * @return $this
     */
    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string|null $lastName
     *
     * @return $this
     */
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return float
     */
    public function getNumberCurrentAbsence(): float
    {
        return $this->numberCurrentAbsence;
    }

    /**
     * @param float $numberCurrentAbsence
     *
     * @return $this
     */
    public function setNumberCurrentAbsence(float $numberCurrentAbsence): self
    {
        $this->numberCurrentAbsence = $numberCurrentAbsence;

        return $this;
    }
}
