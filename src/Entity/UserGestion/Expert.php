<?php

namespace App\Entity\UserGestion;

use App\Entity\CourseGestion\Course;

use App\Repository\UserGestion\ExpertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExpertRepository::class)]
class Expert extends NormalUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'id_Expert', targetEntity: course::class)]
    private Collection $accepted_Courses;

    public function __construct()
    {
        parent::__construct();
        $this->accepted_Courses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Course>
     */
    public function getAcceptedCourses(): Collection
    {
        return $this->accepted_Courses;
    }

    public function addAcceptedCourse(Course $acceptedCourse): static
    {
        if (!$this->accepted_Courses->contains($acceptedCourse)) {
            $this->accepted_Courses->add($acceptedCourse);
            $acceptedCourse->setIdExpert($this);
        }

        return $this;
    }

    public function removeAcceptedCourse(Course $acceptedCourse): static
    {
        if ($this->accepted_Courses->removeElement($acceptedCourse)) {
            // set the owning side to null (unless already changed)
            if ($acceptedCourse->getIdExpert() === $this) {
                $acceptedCourse->setIdExpert(null);
            }
        }

        return $this;
    }


}