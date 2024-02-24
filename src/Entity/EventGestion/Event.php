<?php

namespace App\Entity\EventGestion;

use App\Entity\UserGestion\NormalUser;
use App\Repository\EventGestion\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $location = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $details = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $city = null;

    #[ORM\ManyToMany(targetEntity: NormalUser::class, mappedBy: 'Participated_events')]
    private Collection $participants;

    #[ORM\OneToMany(mappedBy: 'event', targetEntity: Competition::class, orphanRemoval: true)]
    private Collection $competitions;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->competitions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function setLocation(string $location): static
    {
        $this->location = $location;

        return $this;
    }
    public function getLocation(): ?string
    {
        return $this->location;
    }
    public function settype(string $type): static
    {
        $this->type = $type;

        return $this;
    }
    public function gettype(): ?string
    {
        return $this->type;
    }
    public function setdetails(string $details): static
    {
        $this->details = $details;

        return $this;
    }
    public function getdetails(): ?string
    {
        return $this->details;
    }
    public function setcity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
    public function getcity(): ?string
    {
        return $this->city;
    }
    // Other getters and setters...

    /**
     * @return Collection<int, Competition>
     */
    public function getCompetitions(): Collection
    {
        return $this->competitions;
    }

    public function addCompetition(Competition $competition): static
    {
        if (!$this->competitions->contains($competition)) {
            $this->competitions->add($competition);
            $competition->setEvent($this);
        }

        return $this;
    }

    public function removeCompetition(Competition $competition): static
    {
        if ($this->competitions->removeElement($competition)) {
            // set the owning side to null (unless already changed)
            if ($competition->getEvent() === $this) {
                $competition->setEvent(null);
            }
        }

        return $this;
    }
}
