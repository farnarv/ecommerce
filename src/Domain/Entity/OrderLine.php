<?php

namespace App\Domain\Entity;

class OrderLine
{
    private Product $product;
    private int     $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product  = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->product->getPrice() * $this->getQuantity();
    }
}
