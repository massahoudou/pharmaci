<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 *  @Vich\Uploadable
 */
class Pays
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
    private $nom;

    /**
     *  @Vich\UploadableField(mapping="pays", fileNameProperty="image", size="")
     * @var File|null 
     */
    private $fichier;
    /**
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="pays")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Conseil::class, mappedBy="pays")
     */
    private $Conseils;

    /**
     * @ORM\OneToMany(targetEntity=Vignette::class, mappedBy="Pays")
     */
    private $vignettes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $misajour;

    /**
     * @ORM\OneToMany(targetEntity=Pub::class, mappedBy="pays")
     */
    private $pubs;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->Conseils = new ArrayCollection();
        $this->vignettes = new ArrayCollection();
        $this->pubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

 
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setPays($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getPays() === $this) {
                $article->setPays(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
      return   $this->nom;
    }

    /**
     * @return Collection|Conseil[]
     */
    public function getConseils(): Collection
    {
        return $this->Conseils;
    }

    public function addConseil(Conseil $Conseil): self
    {
        if (!$this->Conseils->contains($Conseil)) {
            $this->Conseils[] = $Conseil;
            $Conseil->setPays($this);
        }

        return $this;
    }

    public function removeConseil(Conseil $Conseil): self
    {
        if ($this->Conseils->removeElement($Conseil)) {
            // set the owning side to null (unless already changed)
            if ($Conseil->getPays() === $this) {
                $Conseil->setPays(null);
            }
        }

        return $this;
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
            $vignette->setPays($this);
        }

        return $this;
    }

    public function removeVignette(Vignette $vignette): self
    {
        if ($this->vignettes->removeElement($vignette)) {
            // set the owning side to null (unless already changed)
            if ($vignette->getPays() === $this) {
                $vignette->setPays(null);
            }
        }

        return $this;
    }
    public function setFichier(?File $fichier = null): void
    {
        $this->fichier = $fichier;

        if (null !== $fichier) {

            $this->misajour = new \DateTimeImmutable();
        }
    }


    public function getFichier(): ?File
    {
        return $this->fichier;
    }

    public function getMisajour(): ?\DateTimeInterface
    {
        return $this->misajour;
    }

    public function setMisajour(?\DateTimeInterface $misajour): self
    {
        $this->misajour = $misajour;

        return $this;
    }

    /**
     * @return Collection|Pub[]
     */
    public function getPubs(): Collection
    {
        return $this->pubs;
    }

    public function addPub(Pub $pub): self
    {
        if (!$this->pubs->contains($pub)) {
            $this->pubs[] = $pub;
            $pub->setPays($this);
        }

        return $this;
    }

    public function removePub(Pub $pub): self
    {
        if ($this->pubs->removeElement($pub)) {
            // set the owning side to null (unless already changed)
            if ($pub->getPays() === $this) {
                $pub->setPays(null);
            }
        }

        return $this;
    }
}
