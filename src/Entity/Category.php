<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="categorie")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Vignette::class, mappedBy="Categorie")
     */
    private $vignettes;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->vignettes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }



    public function __toString()
    {
           return $this->titre;
    }

    /**
     * @return Collection|Vignette[]
     */
    public function getVignettes(): Collection
    {
        return $this->vignettes;
    }

    public function addVignette(Vignette $vignette): self
    {
        if (!$this->vignettes->contains($vignette)) {
            $this->vignettes[] = $vignette;
            $vignette->setCategorie($this);
        }

        return $this;
    }

    public function removeVignette(Vignette $vignette): self
    {
        if ($this->vignettes->removeElement($vignette)) {
            // set the owning side to null (unless already changed)
            if ($vignette->getCategorie() === $this) {
                $vignette->setCategorie(null);
            }
        }

        return $this;
    }
}
