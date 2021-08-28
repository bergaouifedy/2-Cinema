<?php

namespace App\Entity;
 

class RechercheAnnonce
{
    /**
     * @var int|null
     */
    private $ville;

    /**
     * @var int|null
     */
    private $maxPrix;

  

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville= $ville;
        return $this;
    }


    public function getMaxPrix(): ?int
    {
        return $this->maxPrix;
    }

    public function setMaxPrix(int $maxPrix): self
    {
        $this->maxPrix= $maxPrix;
        return $this;
    }
}