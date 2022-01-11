<?php

namespace App\Entity;

use App\Repository\VignetteRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=VignetteRepository::class)
 * @vich\Uploadable
 *  @UniqueEntity(
 *     fields={"titre"},
 *     message="Existe déja"
 * )
 */
class Vignette
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation;

    /**
     *  @Vich\UploadableField(mapping="vignettes", fileNameProperty="image", size="")
     * @var File|null
     */
    private $fichier;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $flip;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $misajour;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="vignettes")
     */
    private $pays;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="vignettes")
     */
    private $categorie;

    public function __construct()
    {
        $this->creation = new \DateTime();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreation(): ?\DateTimeInterface
    {
        return $this->creation;
    }

    public function setCreation(\DateTimeInterface $creation): self
    {
        $this->creation = $creation;

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


    public function getFlip(): ?string
    {
        return $this->flip;
    }

    public function setFlip(?string $flip): self
    {
        $this->flip = $flip;

        return $this;
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

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getcategorie(): ?Category
    {
        return $this->categorie;
    }

    public function setCategorie(?Category $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
