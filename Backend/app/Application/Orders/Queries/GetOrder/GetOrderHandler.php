<?php
namespace App\Application\Orders\Queries\GetOrder;

use App\Domain\Repositories\OrderRepositoryInterface;

class GetOrderHandler
{
    public function __construct(private OrderRepositoryInterface $orderRepository) {}

    public function handle(GetOrderQuery $query): array
    {
        $order = $this->orderRepository->getOrderDetails($query->orderId);

        return $order;
    }
}
