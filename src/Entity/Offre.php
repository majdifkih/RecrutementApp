<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'Offre_Type',type: 'string')]
#[ORM\DiscriminatorMap(["Offre"=>Offre::class,"Internship"=>InternShip::class,"Job"=>Job::class])]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(length: 255)]
    private ?string $Title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Limit_Date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Req_Skills = null;

    public function getReqSkills(): ?string
    {
        return $this->Req_Skills;
    }

    public function setReqSkills(?string $Req_Skills): void
    {
        $this->Req_Skills = $Req_Skills;
    }

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Mission = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToMany(targetEntity: Candidat::class, mappedBy: 'Offre')]
    private Collection $candidats;

    #[ORM\ManyToOne(inversedBy: 'Offre')]
    private ?Recruiter $recruiter = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $TimeType = null;

    public function __construct()
    {
        $this->candidats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLimitDate(): ?\DateTimeInterface
    {
        return $this->Limit_Date;
    }

    public function setLimitDate(?\DateTimeInterface $Limit_Date): static
    {
        $this->Limit_Date = $Limit_Date;

        return $this;
    }



    public function getMission(): ?string
    {
        return $this->Mission;
    }

    public function setMission(?string $Mission): static
    {
        $this->Mission = $Mission;

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

    /**
     * @return Collection<int, Candidat>
     */
    public function getCandidats(): Collection
    {
        return $this->candidats;
    }

    public function addCandidat(Candidat $candidat): static
    {
        if (!$this->candidats->contains($candidat)) {
            $this->candidats->add($candidat);
            $candidat->addOffre($this);
        }

        return $this;
    }

    public function removeCandidat(Candidat $candidat): static
    {
        if ($this->candidats->removeElement($candidat)) {
            $candidat->removeOffre($this);
        }

        return $this;
    }

    public function getRecruiter(): ?Recruiter
    {
        return $this->recruiter;
    }

    public function setRecruiter(?Recruiter $recruiter): static
    {
        $this->recruiter = $recruiter;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(?string $Location): static
    {
        $this->Location = $Location;

        return $this;
    }

    public function getTimeType(): ?string
    {
        return $this->TimeType;
    }

    public function setTimeType(?string $TimeType): static
    {
        $this->TimeType = $TimeType;

        return $this;
    }
}
