<?php

namespace App\Domain\Repositories;

interface OrderRepositoryInterface
{
    public function listOrders(): array;
    public function createOrder(array $data);
    public function createOrderItem(int $orderId, array $item);
    public function advanceOrder(int $orderId);
    public function getOrder(int $orderId);
}
