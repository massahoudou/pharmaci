<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 *  @UniqueEntity(
 *     fields={"identifiant"},
 *     message="Existe déja"
 * )
 */
class Users implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motdepasse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pin;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): self
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPin(): ?string
    {
        return $this->pin;
    }

    public function setPin(string $pin): self
    {
        $this->pin = $pin;

        return $this;
    }
    public function getUserIdentifier()
    {
        return $this->identifiant;
    }
    public function getUsername()
    {
        return $this->identifiant;
    }
    public function getPassword()
    {
        return $this->motdepasse;
    }
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }
    public function getSalt()
    {
        return null ;
    }
    public function eraseCredentials()
    {

    }
}
