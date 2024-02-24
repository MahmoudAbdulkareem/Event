<?php

namespace App\Entity\UserGestion;


use App\Entity\CourseGestion\Course;
use App\Entity\CourseGestion\Certificate;
use App\Entity\CourseGestion\RoadMap;

use App\Entity\EventGestion\Event;
use App\Entity\EventGestion\GroupCompetition;

use App\Repository\UserGestion\NormalUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NormalUserRepository::class)]
class NormalUser extends GlobalUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $CV = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Experience_Level = null;

    #[ORM\Column]
    private ?float $Score = null;

    #[ORM\ManyToMany(targetEntity: course::class, inversedBy: 'Users')]
    private Collection $Courses;

    #[ORM\OneToMany(mappedBy: 'owner', targetEntity: course::class, orphanRemoval: true)]
    private Collection $Published_Courses;

    #[ORM\ManyToMany(targetEntity: RoadMap::class, inversedBy: 'users')]
    private Collection $RoadMaps;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'participants')]
    private Collection $Participated_events;

    #[ORM\ManyToMany(targetEntity: GroupCompetition::class, mappedBy: 'team')]
    private Collection $groups_competitions;

    #[ORM\ManyToMany(targetEntity: Certificate::class, inversedBy: 'cerfified_users')]
    private Collection $Certifcates;


    public function __construct()
    {
        $this->Courses = new ArrayCollection();
        $this->Published_Courses = new ArrayCollection();
        $this->RoadMaps = new ArrayCollection();
        $this->Participated_events = new ArrayCollection();
        $this->groups_competitions = new ArrayCollection();
        $this->Certifcates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCV(): ?string
    {
        return $this->CV;
    }

    public function setCV(?string $CV): static
    {
        $this->CV = $CV;

        return $this;
    }

    public function getExperienceLevel(): ?string
    {
        return $this->Experience_Level;
    }

    public function setExperienceLevel(?string $Experience_Level): static
    {
        $this->Experience_Level = $Experience_Level;

        return $this;
    }

    public function getScore(): ?float
    {
        return $this->Score;
    }

    public function setScore(float $Score): static
    {
        $this->Score = $Score;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->Courses;
    }

    public function addCourse(Course $course): static
    {
        if (!$this->Courses->contains($course)) {
            $this->Courses->add($course);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        $this->Courses->removeElement($course);

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getPublishedCourses(): Collection
    {
        return $this->Published_Courses;
    }

    public function addPublishedCourse(Course $publishedCourse): static
    {
        if (!$this->Published_Courses->contains($publishedCourse)) {
            $this->Published_Courses->add($publishedCourse);
            $publishedCourse->setOwner($this);
        }

        return $this;
    }

    public function removePublishedCourse(Course $publishedCourse): static
    {
        if ($this->Published_Courses->removeElement($publishedCourse)) {
            // set the owning side to null (unless already changed)
            if ($publishedCourse->getOwner() === $this) {
                $publishedCourse->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoadMap>
     */
    public function getRoadMaps(): Collection
    {
        return $this->RoadMaps;
    }

    public function addRoadMap(RoadMap $roadMap): static
    {
        if (!$this->RoadMaps->contains($roadMap)) {
            $this->RoadMaps->add($roadMap);
        }

        return $this;
    }

    public function removeRoadMap(RoadMap $roadMap): static
    {
        $this->RoadMaps->removeElement($roadMap);

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getParticipatedEvents(): Collection
    {
        return $this->Participated_events;
    }

    public function addParticipatedEvent(Event $participatedEvent): static
    {
        if (!$this->Participated_events->contains($participatedEvent)) {
            $this->Participated_events->add($participatedEvent);
        }

        return $this;
    }

    public function removeParticipatedEvent(Event $participatedEvent): static
    {
        $this->Participated_events->removeElement($participatedEvent);

        return $this;
    }

    /**
     * @return Collection<int, GroupCompetition>
     */
    public function getGroupsCompetitions(): Collection
    {
        return $this->groups_competitions;
    }

    public function addGroupsCompetition(GroupCompetition $groupsCompetition): static
    {
        if (!$this->groups_competitions->contains($groupsCompetition)) {
            $this->groups_competitions->add($groupsCompetition);
            $groupsCompetition->addTeam($this);
        }

        return $this;
    }

    public function removeGroupsCompetition(GroupCompetition $groupsCompetition): static
    {
        if ($this->groups_competitions->removeElement($groupsCompetition)) {
            $groupsCompetition->removeTeam($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Certificate>
     */
    public function getCertifcates(): Collection
    {
        return $this->Certifcates;
    }

    public function addCertifcate(Certificate $certifcate): static
    {
        if (!$this->Certifcates->contains($certifcate)) {
            $this->Certifcates->add($certifcate);
        }

        return $this;
    }

    public function removeCertifcate(Certificate $certifcate): static
    {
        $this->Certifcates->removeElement($certifcate);

        return $this;
    }
    }
