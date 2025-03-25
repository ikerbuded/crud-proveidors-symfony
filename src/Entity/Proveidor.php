<?php

namespace App\Entity;

use App\Validator\UniqueEmail;
use App\Validator\UniqueTelefon;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank(message="El nom no pot estar buit.")
     * @Assert\Length(max=150, maxMessage="El nom no pot tenir més de 150 caràcters.")
     */
    private ?string $nom = null;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     * @Assert\NotBlank(message="L'email no pot estar buit.")
     * @Assert\Length(max=150, maxMessage="El email no pot tenir més de 150 caràcters.")
     * @Assert\Email(message="L'email no és vàlid.")
     * @UniqueEmail
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", length=9, unique=true)
     * @Assert\NotBlank(message="El telèfon no pot estar buit.")
     * @Assert\Regex(
     *     pattern="/^\d{9}$/",
     *     message="El telèfon ha de tenir exactament 9 dígits."
     * )
     * @UniqueTelefon
     */
    private ?string $telefon = null;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="El tipus de proveïdor no pot estar buit.")
     */
    private ?string $tipus = null;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $actiu = true;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private ?\DateTimeImmutable $dataCreacio = null;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $dataActualitzacio = null;

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
