<?php

namespace App\Entity\CourseGestion;

use App\Entity\UserGestion\NormalUser;

use App\Repository\CourseGestion\RoadMapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoadMapRepository::class)]
class RoadMap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $rate = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\ManyToMany(targetEntity: Course::class, inversedBy: 'roadMaps')]
    private Collection $courses;

    #[ORM\ManyToMany(targetEntity: NormalUser::class, mappedBy: 'RoadMaps')]
    private Collection $users;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): static
    {
        if (!$this->courses->contains($course)) {
            $this->courses->add($course);
        }

        return $this;
    }

    public function removeCourse(Course $course): static
    {
        $this->courses->removeElement($course);

        return $this;
    }

    /**
     * @return Collection<int, NormalUser>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(NormalUser $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRoadMap($this);
        }

        return $this;
    }

    public function removeUser(NormalUser $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeRoadMap($this);
        }

        return $this;
    }

}
