<?php

namespace App\Http;

use App\Application\Exception\UserNotLoggedInException;
use App\Application\Exception\WrongOrderOwnerException;
use App\Application\UseCase\CheckoutResponse;
use App\Application\UseCase\CheckoutUseCase;
use App\Domain\Service\CheckoutService;
use App\Infrastructure\Persistence\InMemory\OrderRepository;
use App\Infrastructure\Context\LoggedInUserContext;

class CheckoutController
{
    public function checkout(string $orderId): CheckoutResponse
    {
        $useCase = new CheckoutUseCase(
            new CheckoutService(),
            new LoggedInUserContext(),
            new OrderRepository()
        );

        try {
            return $useCase->execute($orderId);
        } catch (UserNotLoggedInException $e) {
            // Redirect to Login Page or return the JSON object indicating the error
        } catch (WrongOrderOwnerException $e) {
            // Redirect to Error Page or return the JSON object indicating the error
        }
    }
}
