<?php

namespace App\Entity;

use App\Repository\ProveidorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProveidorRepository::class)
 */
class Proveidor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $telefon;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipus;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actiu;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $dataCreacio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dataActualitzacio;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefon(): ?string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): self
    {
        $this->telefon = $telefon;

        return $this;
    }

    public function getTipus(): ?string
    {
        return $this->tipus;
    }

    public function setTipus(string $tipus): self
    {
        $this->tipus = $tipus;

        return $this;
    }

    public function getActiu(): ?bool
    {
        return $this->actiu;
    }

    public function setActiu(bool $actiu): self
    {
        $this->actiu = $actiu;

        return $this;
    }

    public function getDataCreacio(): ?\DateTimeImmutable
    {
        return $this->dataCreacio;
    }

    public function setDataCreacio(\DateTimeImmutable $dataCreacio): self
    {
        $this->dataCreacio = $dataCreacio;

        return $this;
    }

    public function getDataActualitzacio(): ?\DateTimeInterface
    {
        return $this->dataActualitzacio;
    }

    public function setDataActualitzacio(\DateTimeInterface $dataActualitzacio): self
    {
        $this->dataActualitzacio = $dataActualitzacio;

        return $this;
    }
}
