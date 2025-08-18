<?php
namespace App\Application\Orders\Commands\AdvanceOrder;

use App\Domain\Repositories\OrderRepositoryInterface;

class AdvanceOrderHandler
{
    public function __construct(private OrderRepositoryInterface $orderRepository) {}

    public function handle(AdvanceOrderCommand $command): array
    {
        return $this->orderRepository->advanceOrder($command->orderId);
    }
}
