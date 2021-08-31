<?php

namespace App\Command;

use App\Application\Exception\UserNotLoggedInException;
use App\Application\Exception\WrongOrderOwnerException;
use App\Application\UseCase\CheckoutUseCase;
use App\Domain\Service\CheckoutService;
use App\Infrastructure\Context\LoggedInUserContext;
use App\Infrastructure\Persistence\InMemory\OrderRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class CheckoutCommand extends Command
{
    protected static $defaultName = 'order:checkout';

    protected function configure(): void
    {
        $this
            ->setDescription('Let\'s make a checkout')
            ->setHelp('This command allows you to make a checkout against an order...')
            ->addArgument('orderId', InputArgument::REQUIRED, 'Order ID to make a checkout');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table   = new Table($output);
        $orderId = $input->getArgument('orderId');

        $useCase = new CheckoutUseCase(
            new CheckoutService(),
            new LoggedInUserContext(),
            new OrderRepository()
        );

        try {
            $result = $useCase->execute($orderId);

            $table
                ->setHeaders(['ORDER ID', 'TOTAL PRICE'])
                ->setRows([
                    [$orderId, $result->getTotalPrice()],
                ]);
            $table->render();
        } catch (UserNotLoggedInException | WrongOrderOwnerException $e) {
            // React to exception
            $output->writeln('<comment>' . $e->getMessage() . '</comment>');
        }

        return Command::SUCCESS;
    }
}
