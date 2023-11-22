<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]

class Recruiter extends User
{
    #[ORM\Column(length: 255)]
    private ?string $Company_Name = null;
    public function getCompanyName(): ?string
    {
        return $this->Company_Name;
    }

    public function setCompanyName(string $Company_Name): static
    {
        $this->Company_Name = $Company_Name;

        return $this;
    }
}
