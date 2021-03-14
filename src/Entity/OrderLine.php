<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderLineRepository::class)
 */
class OrderLine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=order::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_order;

    /**
     * @ORM\OneToOne(targetEntity=product::class, cascade={"persist", "remove"})
     */
    private $id_product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="id_order_line")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_related;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOrder(): ?order
    {
        return $this->id_order;
    }

    public function setIdOrder(?order $id_order): self
    {
        $this->id_order = $id_order;

        return $this;
    }

    public function getIdProduct(): ?product
    {
        return $this->id_product;
    }

    public function setIdProduct(?product $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderRelated(): ?Order
    {
        return $this->order_related;
    }

    public function setOrderRelated(?Order $order_related): self
    {
        $this->order_related = $order_related;

        return $this;
    }
}
