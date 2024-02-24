<?php

namespace App\Entity\OffreGestion;

use App\Entity\UserGestion\GlobalUser;

use App\Repository\OffreGestion\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'Offres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $id_category = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(length: 255)]
    private ?string $Type_Offre = null;

    #[ORM\Column]
    private ?int $Experience_Level = null;

    #[ORM\Column]
    private ?float $Salary = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Expiration_Date = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    private ?string $Language = null;

    #[ORM\Column]
    private ?int $Priority = null;

    #[ORM\OneToOne(mappedBy: 'id_Offre', cascade: ['persist', 'remove'])]
    private ?Chat $chat = null;

    #[ORM\OneToOne(mappedBy: 'id_Contract', cascade: ['persist', 'remove'])]
    private ?Contract $contract = null;

    #[ORM\ManyToOne(inversedBy: 'Offers_created')]
    private ?GlobalUser $id_creator = null;

    #[ORM\ManyToMany(targetEntity: GlobalUser::class, inversedBy: 'Submitted_Offers')]
    private Collection $id_Other_Part;

    public function __construct()
    {
        $this->id_Other_Part = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getTypeOffre(): ?string
    {
        return $this->Type_Offre;
    }

    public function setTypeOffre(string $Type_Offre): static
    {
        $this->Type_Offre = $Type_Offre;

        return $this;
    }

    public function getExperienceLevel(): ?int
    {
        return $this->Experience_Level;
    }

    public function setExperienceLevel(int $Experience_Level): static
    {
        $this->Experience_Level = $Experience_Level;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->Salary;
    }

    public function setSalary(float $Salary): static
    {
        $this->Salary = $Salary;

        return $this;
    }

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->Expiration_Date;
    }

    public function setExpirationDate(\DateTimeInterface $Expiration_Date): static
    {
        $this->Expiration_Date = $Expiration_Date;

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

    public function setLanguage(string $Language): static
    {
        $this->Language = $Language;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->Priority;
    }

    public function setPriority(int $Priority): static
    {
        $this->Priority = $Priority;

        return $this;
    }

    public function getIdCategory(): ?categorie
    {
        return $this->id_category;
    }

    public function setIdCategory(?categorie $id_category): static
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): static
    {
        // unset the owning side of the relation if necessary
        if ($chat === null && $this->chat !== null) {
            $this->chat->setIdOffre(null);
        }

        // set the owning side of the relation if necessary
        if ($chat !== null && $chat->getIdOffre() !== $this) {
            $chat->setIdOffre($this);
        }

        $this->chat = $chat;

        return $this;
    }

    public function getContract(): ?Contract
    {
        return $this->contract;
    }

    public function setContract(?Contract $contract): static
    {
        // unset the owning side of the relation if necessary
        if ($contract === null && $this->contract !== null) {
            $this->contract->setIdContract(null);
        }

        // set the owning side of the relation if necessary
        if ($contract !== null && $contract->getIdContract() !== $this) {
            $contract->setIdContract($this);
        }

        $this->contract = $contract;

        return $this;
    }

    public function getIdCreator(): ?GlobalUser
    {
        return $this->id_creator;
    }

    public function setIdCreator(?GlobalUser $id_creator): static
    {
        $this->id_creator = $id_creator;

        return $this;
    }

    /**
     * @return Collection<int, GlobalUser>
     */
    public function getIdOtherPart(): Collection
    {
        return $this->id_Other_Part;
    }

    public function addIdOtherPart(GlobalUser $idOtherPart): static
    {
        if (!$this->id_Other_Part->contains($idOtherPart)) {
            $this->id_Other_Part->add($idOtherPart);
        }

        return $this;
    }

    public function removeIdOtherPart(GlobalUser $idOtherPart): static
    {
        $this->id_Other_Part->removeElement($idOtherPart);

        return $this;
    }


}
//Competence
///id_employer
///id_employee