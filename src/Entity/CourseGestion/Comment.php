<?php

namespace App\Entity\CourseGestion;

use App\Entity\UserGestion\GlobalUser;

use App\Repository\CourseGestion\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?course $id_course = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'Comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GlobalUser $Users = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getIdCourse(): ?course
    {
        return $this->id_course;
    }

    public function setIdCourse(?course $id_course): static
    {
        $this->id_course = $id_course;

        return $this;
    }

    public function getUsers(): ?GlobalUser
    {
        return $this->Users;
    }

    public function setUsers(?GlobalUser $Users): static
    {
        $this->Users = $Users;

        return $this;
    }

}
