<?php

namespace App\Entity\UserGestion;

use App\Repository\UserGestion\BusinessRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusinessRepository::class)]
class Business extends GlobalUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $web_site = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebSite(): ?string
    {
        return $this->web_site;
    }

    public function setWebSite(string $web_site): static
    {
        $this->web_site = $web_site;

        return $this;
    }
}
