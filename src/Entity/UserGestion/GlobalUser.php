<?php

namespace App\Entity\UserGestion;

use App\Entity\OffreGestion\Offre;
use App\Entity\OffreGestion\Message;
use App\Entity\OffreGestion\Chat;
use App\Entity\ComplaintGestion\Complaint;
use App\Entity\CourseGestion\Comment;

use App\Repository\UserGestion\GlobalUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: GlobalUserRepository::class)]

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name:"Role",type:"string")]
#[ORM\DiscriminatorMap(["NormalUser","Business","Admin","Expert"])]
class GlobalUser 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 16)]
    private ?string $Name = null;

    #[ORM\Column(length: 16)]
    private ?string $Family_Name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Image = null;

    #[ORM\Column(nullable: true)]
    private ?int $Phone_Number = null;

    #[ORM\Column(length: 40)]
    private ?string $Email = null;

    #[ORM\Column(length: 20)]
    private ?string $Nationality = null;

    #[ORM\Column(length: 20)]
    private ?string $Language = null;

    #[ORM\Column]
    private ?int $Reputation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Description = null;

    #[ORM\OneToMany(mappedBy: 'id_creator', targetEntity: Offre::class)]
    private Collection $Offers_created;

    #[ORM\ManyToMany(targetEntity: Offre::class, mappedBy: 'id_Other_Part')]
    private Collection $Submitted_Offers;

    #[ORM\OneToMany(mappedBy: 'id_Sender', targetEntity: Message::class)]
    private Collection $messages;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: complaint::class, orphanRemoval: true)]
    private Collection $Complaints;

    #[ORM\ManyToMany(targetEntity: chat::class, inversedBy: 'users')]
    private Collection $Chats;

    #[ORM\OneToMany(mappedBy: 'Users', targetEntity: Comment::class, orphanRemoval: true)]
    private Collection $Comments;

    public function __construct()
    {
        $this->Offers_created = new ArrayCollection();
        $this->Submitted_Offers = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->Complaints = new ArrayCollection();
        $this->Chats = new ArrayCollection();
        $this->Comments = new ArrayCollection();
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

    public function getFamilyName(): ?string
    {
        return $this->Family_Name;
    }

    public function setFamilyName(string $Family_Name): static
    {
        $this->Family_Name = $Family_Name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->Phone_Number;
    }

    public function setPhoneNumber(?int $Phone_Number): static
    {
        $this->Phone_Number = $Phone_Number;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->Nationality;
    }

    public function setNationality(string $Nationality): static
    {
        $this->Nationality = $Nationality;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->Language;
    }

    public function setLanguage(string $Language): static
    {
        $this->Language = $Language;

        return $this;
    }

    public function getReputation(): ?int
    {
        return $this->Reputation;
    }

    public function setReputation(int $Reputation): static
    {
        $this->Reputation = $Reputation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffersCreated(): Collection
    {
        return $this->Offers_created;
    }

    public function addOffersCreated(Offre $offersCreated): static
    {
        if (!$this->Offers_created->contains($offersCreated)) {
            $this->Offers_created->add($offersCreated);
            $offersCreated->setIdCreator($this);
        }

        return $this;
    }

    public function removeOffersCreated(Offre $offersCreated): static
    {
        if ($this->Offers_created->removeElement($offersCreated)) {
            // set the owning side to null (unless already changed)
            if ($offersCreated->getIdCreator() === $this) {
                $offersCreated->setIdCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getSubmittedOffers(): Collection
    {
        return $this->Submitted_Offers;
    }

    public function addSubmittedOffer(Offre $submittedOffer): static
    {
        if (!$this->Submitted_Offers->contains($submittedOffer)) {
            $this->Submitted_Offers->add($submittedOffer);
            $submittedOffer->addIdOtherPart($this);
        }

        return $this;
    }

    public function removeSubmittedOffer(Offre $submittedOffer): static
    {
        if ($this->Submitted_Offers->removeElement($submittedOffer)) {
            $submittedOffer->removeIdOtherPart($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setIdSender($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdSender() === $this) {
                $message->setIdSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Complaint>
     */
    public function getComplaints(): Collection
    {
        return $this->Complaints;
    }

    public function addComplaint(Complaint $complaint): static
    {
        if (!$this->Complaints->contains($complaint)) {
            $this->Complaints->add($complaint);
            $complaint->setIdUser($this);
        }

        return $this;
    }

    public function removeComplaint(Complaint $complaint): static
    {
        if ($this->Complaints->removeElement($complaint)) {
            // set the owning side to null (unless already changed)
            if ($complaint->getIdUser() === $this) {
                $complaint->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chat>
     */
    public function getChats(): Collection
    {
        return $this->Chats;
    }

    public function addChat(Chat $chat): static
    {
        if (!$this->Chats->contains($chat)) {
            $this->Chats->add($chat);
        }

        return $this;
    }

    public function removeChat(Chat $chat): static
    {
        $this->Chats->removeElement($chat);

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->Comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->Comments->contains($comment)) {
            $this->Comments->add($comment);
            $comment->setUsers($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->Comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUsers() === $this) {
                $comment->setUsers(null);
            }
        }

        return $this;
    }
}