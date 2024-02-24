<?php

namespace App\Entity\CourseGestion;

use App\Entity\UserGestion\Expert;
use App\Entity\UserGestion\NormalUser;


use App\Repository\CourseGestion\CourseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Title = null;

    #[ORM\Column(length: 255)]
    private ?string $Thumbnail = null;
    
    #[ORM\Column(length: 255)]
    private ?string $Category = null;

    #[ORM\Column]
    private ?float $Rate = null;

    #[ORM\Column]
    private ?bool $State = False;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 12, nullable: true)]
    private ?string $Language = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column]
    private ?float $Discount = 0;

    #[ORM\OneToMany(mappedBy: 'id_cours', targetEntity: Article::class, orphanRemoval: true)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'id_Course', targetEntity: Video::class)]
    private Collection $videos;

    #[ORM\ManyToMany(targetEntity: RoadMap::class, mappedBy: 'courses')]
    private Collection $roadMaps;

    #[ORM\OneToMany(mappedBy: 'id_course', targetEntity: Comment::class)]
    private Collection $comments;

    #[ORM\ManyToMany(targetEntity: NormalUser::class, mappedBy: 'Courses')]
    private Collection $Users;

    #[ORM\ManyToOne(inversedBy: 'Published_Courses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NormalUser $owner = null;

    #[ORM\ManyToOne(inversedBy: 'accepted_Courses')]
    private ?Expert $id_Expert = null;



    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->roadMaps = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->Users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->Rate;
    }

    public function setRate(float $Rate): static
    {
        $this->Rate = $Rate;

        return $this;
    }

    public function isState(): ?bool
    {
        return $this->State;
    }

    public function setState(bool $State): static
    {
        $this->State = $State;

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

    public function getLanguage(): ?string
    {
        return $this->Language;
    }

    public function setLanguage(?string $Language): static
    {
        $this->Language = $Language;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->Discount;
    }

    public function setDiscount(float $Discount): static
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): static
    {
        $this->Title = $Title;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->Thumbnail;
    }

    public function setThumbnail(string $Thumbnail): static
    {
        $this->Thumbnail = $Thumbnail;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setIdCours($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getIdCours() === $this) {
                $article->setIdCours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setIdCourse($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getIdCourse() === $this) {
                $video->setIdCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RoadMap>
     */
    public function getRoadMaps(): Collection
    {
        return $this->roadMaps;
    }

    public function addRoadMap(RoadMap $roadMap): static
    {
        if (!$this->roadMaps->contains($roadMap)) {
            $this->roadMaps->add($roadMap);
            $roadMap->addCourse($this);
        }

        return $this;
    }

    public function removeRoadMap(RoadMap $roadMap): static
    {
        if ($this->roadMaps->removeElement($roadMap)) {
            $roadMap->removeCourse($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setIdCourse($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getIdCourse() === $this) {
                $comment->setIdCourse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NormalUser>
     */
    public function getUsers(): Collection
    {
        return $this->Users;
    }

    public function addUser(NormalUser $user): static
    {
        if (!$this->Users->contains($user)) {
            $this->Users->add($user);
            $user->addCourse($this);
        }

        return $this;
    }

    public function removeUser(NormalUser $user): static
    {
        if ($this->Users->removeElement($user)) {
            $user->removeCourse($this);
        }

        return $this;
    }

    public function getOwner(): ?NormalUser
    {
        return $this->owner;
    }

    public function setOwner(?NormalUser $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getIdExpert(): ?Expert
    {
        return $this->id_Expert;
    }

    public function setIdExpert(?Expert $id_Expert): static
    {
        $this->id_Expert = $id_Expert;

        return $this;
    }


}
//creator
//buyers