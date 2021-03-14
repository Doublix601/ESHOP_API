<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $ht;

    /**
     * @ORM\Column(type="integer")
     */
    private $tva;

    /**
     * @ORM\Column(type="integer")
     */
    private $ttc;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_user;

    /**
     * @ORM\ManyToOne(targetEntity=delivery::class, inversedBy="orders")
     */
    private $id_delivery;

    /**
     * @ORM\OneToMany(targetEntity=orderline::class, mappedBy="order_related")
     */
    private $id_order_line;

    public function __construct()
    {
        $this->id_order_line = new ArrayCollection();
    }



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

    public function getTtc(): ?int
    {
        return $this->ttc;
    }

    public function setTtc(int $ttc): self
    {
        $this->ttc = $ttc;

        return $this;
    }

    public function getIdUser(): ?user
    {
        return $this->id_user;
    }

    public function setIdUser(?user $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdDelivery(): ?delivery
    {
        return $this->id_delivery;
    }

    public function setIdDelivery(?delivery $id_delivery): self
    {
        $this->id_delivery = $id_delivery;

        return $this;
    }

    /**
     * @return Collection|orderline[]
     */
    public function getIdOrderLine(): Collection
    {
        return $this->id_order_line;
    }

    public function addIdOrderLine(orderline $idOrderLine): self
    {
        if (!$this->id_order_line->contains($idOrderLine)) {
            $this->id_order_line[] = $idOrderLine;
            $idOrderLine->setOrderRelated($this);
        }

        return $this;
    }

    public function removeIdOrderLine(orderline $idOrderLine): self
    {
        if ($this->id_order_line->removeElement($idOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($idOrderLine->getOrderRelated() === $this) {
                $idOrderLine->setOrderRelated(null);
            }
        }

        return $this;
    }
}
