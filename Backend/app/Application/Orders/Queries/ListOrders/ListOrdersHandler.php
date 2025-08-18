<?php

namespace App\Application\Orders\Queries\ListOrders;

use App\Domain\Repositories\OrderRepositoryInterface;

class ListOrdersHandler
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(ListOrdersQuery $query): array
    {

        $orders = $this->orderRepository->listOrders();

        return $orders;
    }
}
