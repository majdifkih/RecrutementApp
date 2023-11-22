<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
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

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $Req_Skills = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Mission = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

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

    public function getReqSkills(): ?array
    {
        return $this->Req_Skills;
    }

    public function setReqSkills(?array $Req_Skills): static
    {
        $this->Req_Skills = $Req_Skills;

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
}
