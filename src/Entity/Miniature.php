<?php

namespace App\Entity;

use App\Repository\MiniatureRepository;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=MiniatureRepository::class)
 * @Vich\Uploadable
 */
class Miniature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *  @Vich\UploadableField(mapping="miniatures", fileNameProperty="image", size="")
     * @var File|null 
     */
    private $fichier;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $flip;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="miniatures")
     */
    private $pays;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $misajour;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setFlip(string $flip): self
    {
        $this->flip = $flip;

        return $this;
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
}
