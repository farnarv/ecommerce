<?php

namespace App\Domain\Entity;

class Order
{
    private int   $id;
    private array $orderLines;
    private User  $user;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addOrderLine(string $name, float $price, int $quantity)
    {
        $this->orderLines[] = new OrderLine(new Product($name, $price), $quantity);
    }

    public function getOrderLines(): array
    {
        return $this->orderLines;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function calculateTotalPrice(): float
    {
        $total = 0.0;
        foreach ($this->orderLines as $orderLine) {
            $total += $orderLine->getPrice();
        }

        return $total;
    }
}
