<?php

namespace App\Entity\EventGestion;

use App\Entity\UserGestion\NormalUser;

use App\Repository\EventGestion\GroupCompetitionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupCompetitionRepository::class)]
class GroupCompetition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Name = null;

    #[ORM\ManyToMany(targetEntity: normaluser::class, inversedBy: 'groups_competitions')]
    private Collection $team;

    #[ORM\ManyToOne(inversedBy: 'Groups')]
    #[ORM\JoinColumn(nullable: false)]
    private ?competition $competition = null;

    public function __construct()
    {
        $this->team = new ArrayCollection();
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

    /**
     * @return Collection<int, NormalUser>
     */
    public function getTeam(): Collection
    {
        return $this->team;
    }

    public function addTeam(NormalUser $team): static
    {
        if (!$this->team->contains($team)) {
            $this->team->add($team);
        }

        return $this;
    }

    public function removeTeam(NormalUser $team): static
    {
        $this->team->removeElement($team);

        return $this;
    }

    public function getCompetition(): ?competition
    {
        return $this->competition;
    }

    public function setCompetition(?competition $competition): static
    {
        $this->competition = $competition;

        return $this;
    }


}
