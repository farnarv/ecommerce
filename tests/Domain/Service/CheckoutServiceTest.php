<?php

namespace Tests\Domain\Service;

use App\Domain\Entity\Order;
use App\Domain\Service\CheckoutService;
use PHPUnit\Framework\TestCase;

class CheckoutServiceTest extends TestCase
{
    public function testCalculateTotalPrice()
    {
        $order1 = new Order(1);
        $order1->addOrderLine('MacBook 16', 2900.0, 1);
        $order1->addOrderLine('DDD in PHP', 14.9, 2);

        $order2 = new Order(2);
        $order2->addOrderLine('MacBook 13', 1990.0, 2);
        $order2->addOrderLine('Web Application Architecture', 29.9, 3);

        $checkoutService = new CheckoutService();

        $totalPrice1 = $checkoutService->calculateTotalPrice($order1);
        $totalPrice2 = $checkoutService->calculateTotalPrice($order2);

        $this->assertEquals(2929.8, $totalPrice1);
        $this->assertEquals(4069.7, $totalPrice2);
    }
}
