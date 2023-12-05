<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job extends Offre
{
    #[ORM\Column]
    private ?float $Salary_Prop = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $Contract_Type = null;



    public function getSalaryProp(): ?float
    {
        return $this->Salary_Prop;
    }

    public function setSalaryProp(float $Salary_Prop): static
    {
        $this->Salary_Prop = $Salary_Prop;

        return $this;
    }

    public function getContractType(): ?string
    {
        return $this->Contract_Type;
    }

    public function setContractType(?string $Contract_Type): static
    {
        $this->Contract_Type = $Contract_Type;

        return $this;
    }
}
