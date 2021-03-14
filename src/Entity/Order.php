<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $client;

    /**
     * @ORM\Column(type="integer")
     */
    private $products;

    /**
     * @ORM\Column(type="integer")
     */
    private $ht;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     */
    private $ecotax;

    /**
     * @ORM\Column(type="integer")
     */
    private $delivery_price;

    /**
     * @ORM\Column(type="integer")
     */
    private $ttc;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getClient(): ?int
    {
        return $this->client;
    }

    public function setClient(int $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getProducts(): ?int
    {
        return $this->products;
    }

    public function setProducts(int $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getHt(): ?int
    {
        return $this->ht;
    }

    public function setHt(int $ht): self
    {
        $this->ht = $ht;

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

    public function getEcotax(): ?int
    {
        return $this->ecotax;
    }

    public function setEcotax(int $ecotax): self
    {
        $this->ecotax = $ecotax;

        return $this;
    }

    public function getDeliveryPrice(): ?int
    {
        return $this->delivery_price;
    }

    public function setDeliveryPrice(int $delivery_price): self
    {
        $this->delivery_price = $delivery_price;

        return $this;
    }

    public function getTtc(): ?int
    {
        return $this->ttc;
    }

    public function setTtc(int $ttc): self
    {
        $this->ttc = $ttc;

        return $this;
    }
}
