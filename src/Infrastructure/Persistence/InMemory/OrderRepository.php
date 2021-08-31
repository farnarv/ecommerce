<?php

namespace App\Infrastructure\Persistence\InMemory;

use App\Domain\Entity\Order;
use App\Domain\Entity\User;
use App\Domain\Repository\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    private array $orders = [];

    public function __construct()
    {
        $order = new Order(1);
        $order->addOrderLine('MacBook 16', 2900.0, 1);
        $order->addOrderLine('DDD in PHP', 14.9, 2);
        $order->setUser(new User('test@mail.com'));

        $this->orders[] = $order;

        $order = new Order(2);
        $order->addOrderLine('MacBook 13', 1990.0, 2);
        $order->addOrderLine('Web Application Architecture', 29.9, 3);
        $order->setUser(new User('test2@mail.com'));

        $this->orders[] = $order;
    }

    public function findById(int $id): ?Order
    {
        foreach ($this->orders as $order) {
            if ($order->getId() === $id) {
                return $order;
            }
        }

        return null;
    }
}
