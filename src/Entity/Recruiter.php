<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]

class Recruiter extends User
{
    #[ORM\Column(length: 255)]
    private ?string $Company_Name = null;

    #[ORM\OneToMany(mappedBy: 'recruiter', targetEntity: Offre::class,cascade: ['persist','remove'])]
    private Collection $Offre;

    public function __construct()
    {
        $this->Offre = new ArrayCollection();
    }
    public function getCompanyName(): ?string
    {
        return $this->Company_Name;
    }

    public function setCompanyName(string $Company_Name): static
    {
        $this->Company_Name = $Company_Name;

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
            $offre->setRecruiter($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): static
    {
        if ($this->Offre->removeElement($offre)) {
            // set the owning side to null (unless already changed)
            if ($offre->getRecruiter() === $this) {
                $offre->setRecruiter(null);
            }
        }

        return $this;
    }
}
