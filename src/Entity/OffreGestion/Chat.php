<?php

namespace App\Entity\OffreGestion;

use App\Entity\UserGestion\GlobalUser;

use App\Repository\OffreGestion\ChatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChatRepository::class)]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'chat', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?offre $id_Offre = null;

    #[ORM\OneToMany(mappedBy: 'id_Chat_Room', targetEntity: Message::class, orphanRemoval: true)]
    private Collection $messages;
    
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: GlobalUser::class, mappedBy: 'Chats')]
    private Collection $users;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getIdOffre(): ?offre
    {
        return $this->id_Offre;
    }

    public function setIdOffre(offre $id_Offre): static
    {
        $this->id_Offre = $id_Offre;

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
            $message->setIdChatRoom($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getIdChatRoom() === $this) {
                $message->setIdChatRoom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GlobalUser>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(GlobalUser $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addChat($this);
        }

        return $this;
    }

    public function removeUser(GlobalUser $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeChat($this);
        }

        return $this;
    }


}
