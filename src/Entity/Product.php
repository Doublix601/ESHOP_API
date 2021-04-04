<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     * @Groups("product:nb_ventes")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     */
    private $nb_ventes = 0;

    /**
     * @return mixed
     */
    public function getNbVentes()
    {
        return $this->nb_ventes;
    }

    /**
     * @param mixed $nb_ventes
     */
    public function setNbVentes($nb_ventes): void
    {
        $this->nb_ventes = $nb_ventes;
    }

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups("product:read")
     * @Groups("product:label")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     * @Assert\Length(min=5)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=25)
     * @Groups("product:read")
     * @Groups("product:brand")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     * @Assert\Length(min=2)
     */
    private $brand;

    /**
     * @ORM\Column(type="float")
     * @Groups("product:read")
     * @Groups("product:ht_price")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     */
    private $ht_price;

    /**
     * @ORM\Column(type="string", length=10000)
     * @Groups("product:read")
     * @Groups("product:description")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     * @Assert\Length(min=20)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     * @Groups("product:tva")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     * @Groups("product:read")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     */
    private $stock;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("product:read")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     * @Assert\Length(min=3)
     */
    private $img;

    /**
     * @ORM\Column(type="float")
     * @Groups("product:read")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     */
    private $ttc_price;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups("product:read")
     * @Assert\NotBlank(message="Veuillez insérer une donnée")
     * @Assert\Length(min=15)
     */
    private $description_courte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getHtPrice(): ?float
    {
        return $this->ht_price;
    }

    public function setHtPrice(float $ht_price): self
    {
        $this->ht_price = $ht_price;

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

    public function getTva(): ?int
    {
        return $this->tva;
    }

    public function setTva(int $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getTtcPrice(): ?float
    {
        return $this->ttc_price;
    }

    public function setTtcPrice(float $ttc_price): self
    {
        $this->ttc_price = $ttc_price;

        return $this;
    }

    public function getDescriptionCourte(): ?string
    {
        return $this->description_courte;
    }

    public function setDescriptionCourte(string $description_courte): self
    {
        $this->description_courte = $description_courte;

        return $this;
    }

}
