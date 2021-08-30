<?php

namespace App\Entity;


class RechercheAnnonce
{
    /**
     * @var string|null
     */
    private $ville;

    /**
     * @var int|null
     */
    private $maxPrix;

      /**
     * @var object|null
     
     */
    private $category;

  

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville= $ville;
        return $this;
    }

    public function getCategory(): ?object
    {
        return $this->category;
    }

    public function setCategory(object $category): self
    {
        $this->category= $category;
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