<?php

namespace App\Application\UseCase;

use App\Application\Exception\UserNotLoggedInException;
use App\Application\Exception\WrongOrderOwnerException;
use App\Application\UserContextInterface;
use App\Domain\Repository\OrderRepositoryInterface;
use App\Domain\Service\CheckoutService;

class CheckoutUseCase
{
    private CheckoutService          $checkoutService;
    private UserContextInterface     $userContext;
    private OrderRepositoryInterface $orderRepository;

    public function __construct(
        CheckoutService $checkoutService,
        UserContextInterface $userContext,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->checkoutService = $checkoutService;
        $this->userContext     = $userContext;
        $this->orderRepository = $orderRepository;
    }

    public function execute(int $orderId): CheckoutResponse
    {
        if (false === $this->userContext->isLoggedIn()) {
            throw new UserNotLoggedInException('User not logged in');
        }

        $order       = $this->orderRepository->findById($orderId);
        $currentUser = $this->userContext->getCurrentUser();

        if (false === $currentUser->isEqual($order->getUser())) {
            throw new WrongOrderOwnerException('Wrong order owner');
        }

        /**
         * Do some business logic
         */
        $totalPrice = $this->checkoutService->calculateTotalPrice($order);
        // $totalPrice = $order->calculateTotalPrice();

        return new CheckoutResponse($totalPrice);
    }
}
