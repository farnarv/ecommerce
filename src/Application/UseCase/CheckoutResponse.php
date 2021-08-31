<?php

namespace App\Application\UseCase;

class CheckoutResponse
{
    private float $totalPrice;

    public function __construct(float $totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }
}
