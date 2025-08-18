<?php

namespace App\Domain\Interfaces;

interface OrderRepositoryInterface
{
    public function listOrders(): array;
    public function createOrder(array $data);
    public function createOrderItem(int $orderId, array $item);
    public function advanceOrder(int $orderId, string $new_status);
    public function deleteOrder(int $orderId);
    public function createOrderStatusLog(int $orderId, array $item);
    public function getOrderDetails(int $orderId);
    public function getOrder(int $orderId);
}
