<?php

namespace App\Entity\OffreGestion;

use APP\Entity\UserGestion\GlobalUser;

use App\Repository\OffreGestion\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?chat $id_Chat_Room = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'messages')]
    private ?GlobalUser $id_Sender = null;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getIdChatRoom(): ?chat
    {
        return $this->id_Chat_Room;
    }

    public function setIdChatRoom(?chat $id_Chat_Room): static
    {
        $this->id_Chat_Room = $id_Chat_Room;

        return $this;
    }

    public function getIdSender(): ?GlobalUser
    {
        return $this->id_Sender;
    }

    public function setIdSender(?GlobalUser $id_Sender): static
    {
        $this->id_Sender = $id_Sender;

        return $this;
    }


}
//id_employer
//id_employee