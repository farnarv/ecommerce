<?php

namespace App\Domain\Service;

use App\Domain\Entity\Order;

class CheckoutService
{
    public function calculateTotalPrice(Order $order): float
    {
        $total = 0.0;

        foreach ($order->getOrderLines() as $orderLine) {
            $total += $orderLine->getPrice();
        }

        return $total;
    }
}
