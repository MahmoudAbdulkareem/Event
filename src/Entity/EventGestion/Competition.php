<?php

namespace App\Entity\EventGestion;

use App\Repository\EventGestion\CompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetitionRepository::class)]
class Competition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $Location = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column]
    private ?int $Groupe = null;

    #[ORM\ManyToOne(inversedBy: 'competitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    #[ORM\OneToMany(mappedBy: 'competition', targetEntity: GroupCompetition::class, orphanRemoval: true)]
    private Collection $Groups;

    public function __construct()
    {
        $this->Groups = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(string $Location): static
    {
        $this->Location = $Location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getGroupe(): ?int
    {
        return $this->Groupe;
    }

    public function setGroupe(int $Groupe): static
    {
        $this->Groupe = $Groupe;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return Collection<int, GroupCompetition>
     */
    public function getGroups(): Collection
    {
        return $this->Groups;
    }

    public function addGroup(GroupCompetition $group): static
    {
        if (!$this->Groups->contains($group)) {
            $this->Groups->add($group);
            $group->setCompetition($this);
        }

        return $this;
    }

    public function removeGroup(GroupCompetition $group): static
    {
        if ($this->Groups->removeElement($group)) {
            // set the owning side to null (unless already changed)
            if ($group->getCompetition() === $this) {
                $group->setCompetition(null);
            }
        }

        return $this;
    }


}
