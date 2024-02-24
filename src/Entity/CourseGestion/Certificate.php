<?php

namespace App\Entity\CourseGestion;

use App\Entity\UserGestion\NormalUser;

use App\Repository\CourseGestion\CertificateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CertificateRepository::class)]
class Certificate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?course $id_Course = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: NormalUser::class, mappedBy: 'Certifcates')]
    private Collection $cerfified_users;

    public function __construct()
    {
        $this->cerfified_users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getIdCourse(): ?course
    {
        return $this->id_Course;
    }

    public function setIdCourse(?course $id_Course): static
    {
        $this->id_Course = $id_Course;

        return $this;
    }

    /**
     * @return Collection<int, NormalUser>
     */
    public function getCerfifiedUsers(): Collection
    {
        return $this->cerfified_users;
    }

    public function addCerfifiedUser(NormalUser $cerfifiedUser): static
    {
        if (!$this->cerfified_users->contains($cerfifiedUser)) {
            $this->cerfified_users->add($cerfifiedUser);
            $cerfifiedUser->addCertifcate($this);
        }

        return $this;
    }

    public function removeCerfifiedUser(NormalUser $cerfifiedUser): static
    {
        if ($this->cerfified_users->removeElement($cerfifiedUser)) {
            $cerfifiedUser->removeCertifcate($this);
        }

        return $this;
    }


}