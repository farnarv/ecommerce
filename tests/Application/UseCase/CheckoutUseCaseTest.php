<?php

namespace Tests\Application\UseCase;

use App\Application\Exception\UserNotLoggedInException;
use App\Application\Exception\WrongOrderOwnerException;
use App\Application\UseCase\CheckoutUseCase;
use App\Domain\Service\CheckoutService;
use App\Infrastructure\Persistence\InMemory\OrderRepository;
use App\Infrastructure\Context\LoggedInUserContext;
use App\Infrastructure\Context\LoggedOutUserContext;
use PHPUnit\Framework\TestCase;

class CheckoutUseCaseTest extends TestCase
{
    public function testCalculateTotalPrice()
    {
        $useCase = new CheckoutUseCase(
            new CheckoutService(),
            new LoggedInUserContext(),
            new OrderRepository()
        );

        $response = $useCase->execute(1);

        $this->assertEquals(2929.8, $response->getTotalPrice());
    }

    public function testUserNotLoggedIn()
    {
        $this->expectException(UserNotLoggedInException::class);

        $useCase = new CheckoutUseCase(
            new CheckoutService(),
            new LoggedOutUserContext(),
            new OrderRepository()
        );

        $useCase->execute(1);
    }

    public function testWrongProductOwner()
    {
        $this->expectException(WrongOrderOwnerException::class);

        $useCase = new CheckoutUseCase(
            new CheckoutService(),
            new LoggedInUserContext(),
            new OrderRepository()
        );

        $useCase->execute(2);
    }
}
