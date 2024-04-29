<?php 
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RequestDataRepository")
 */
class RequestData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $deliveryDuration;

    /**
     * @ORM\Column(type="integer")
     */
    private $vendorId;

    /**
     * @ORM\Column(type="integer")
     */
    private $warehouseAlias;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDeliveryDuration(): ?float
    {
        return $this->deliveryDuration;
    }

    public function setDeliveryDuration(float $deliveryDuration): self
    {
        $this->deliveryDuration = $deliveryDuration;

        return $this;
    }

    public function getVendorId(): ?int
    {
        return $this->vendorId;
    }

    public function setVendorId(int $vendorId): self
    {
        $this->vendorId = $vendorId;

        return $this;
    }

    public function getWarehouseAlias(): ?int
    {
        return $this->warehouseAlias;
    }

    public function setWarehouseAlias(int $warehouseAlias): self
    {
        $this->warehouseAlias = $warehouseAlias;

        return $this;
    }
}