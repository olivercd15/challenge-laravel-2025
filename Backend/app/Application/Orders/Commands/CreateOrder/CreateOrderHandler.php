<?php

namespace App\Application\Orders\Commands\CreateOrder;

use App\Application\Orders\DTOs\CreateOrderResultDTO;
use App\Domain\Interfaces\OrderRepositoryInterface;

class CreateOrderHandler
{
    public function __construct(private OrderRepositoryInterface $orderRepository) {}

    public function handle(CreateOrderCommand $cmd): CreateOrderResultDTO
    {
        $order = $this->orderRepository->createOrder([
            'client_name' => $cmd->clientName,
            'items' => $cmd->items,
        ]);

        foreach ($cmd->items as $item) {
            $this->orderRepository->createOrderItem($order->id, $item);
        }

        return new CreateOrderResultDTO($order->id, $order->client_name, $order->status);
    }
}
