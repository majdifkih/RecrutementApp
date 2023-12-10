<?php

namespace App\Entity;

use App\Repository\CandidatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatRepository::class)]
class Candidat extends User
{
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birth_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adress = null;

    #[ORM\Column(nullable: true)]
    private ?int $Phone_Number = null;

//    #[ORM\Column(type: Types::ARRAY, nullable: true)]
//    private ?array $skills = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\ManyToMany(targetEntity: Offre::class, inversedBy: 'candidats',cascade: ['persist','remove'])]
    private Collection $Offre;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'candidat')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    private ?User $user = null;

    public function __construct()
    {
        $this->Offre = new ArrayCollection();
    }



    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birth_date;
    }

    public function setBirthDate(?\DateTimeInterface $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(?string $adress): static
    {
        $this->adress = $adress;

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

//    public function getSkills(): ?array
//    {
//        return $this->skills;
//    }
//
//    public function setSkills(?array $skills): static
//    {
//        $this->skills = $skills;
//
//        return $this;
//    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * @return Collection<int, Offre>
     */
    public function getOffre(): Collection
    {
        return $this->Offre;
    }

    public function addOffre(Offre $offre): static
    {
        if (!$this->Offre->contains($offre)) {
            $this->Offre->add($offre);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): static
    {
        $this->Offre->removeElement($offre);

        return $this;
    }

}
