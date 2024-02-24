<?php

namespace App\Entity\OffreGestion;

use App\Repository\OffreGestion\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $Type = null;

    #[ORM\OneToOne(inversedBy: 'contract', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?offre $id_Contract = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    public function getIdContract(): ?offre
    {
        return $this->id_Contract;
    }

    public function setIdContract(offre $id_Contract): static
    {
        $this->id_Contract = $id_Contract;

        return $this;
    }


}
    //id_Employer
    //id_Employee