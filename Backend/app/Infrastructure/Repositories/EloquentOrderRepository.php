<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function listOrders(): array
    {
        return Order::where('status', '!=', 'delivered')->get()->toArray();
    }

    public function createOrder(array $data)
    {
        $total = collect($data['items'])->sum(function ($item) {
            return $item['quantity'] * $item['unit_price'];
        });

        $data['status'] = 'initiated';
        $data['total'] = $total;

        return Order::create($data);
    }

    public function createOrderItem(int $orderId, array $item)
    {
        $description = $item['description'];
        $quantity    = $item['quantity'];
        $unit_price  = $item['unit_price'];

        return OrderItem::create([
            'order_id'    => $orderId,
            'description' => $description,
            'quantity'    => $quantity,
            'unit_price'  => $unit_price,
        ]);
    }

    public function advanceOrder(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();

        if (!$order) {
            return [];
        }

        $transitions = [
            'initiated' => 'sent',
            'sent' => 'delivered'
        ];

        $order->status = $transitions[$order->status];

        if ($order->status === 'delivered') {
            $order->delete();
            return ['message' => 'Order delivered and removed'];
        }

        $order->save();

        return [
            'id' => $order->id,
            'status' => $order->status,
            'message' => 'Order status updated'
        ];
    }


    public function getOrder(int $orderId)
    {
        $order = Order::where('id', $orderId)
            ->with('items')
            ->first();

        if (!$order) {
            return [];
        }

        return [
            'id' => $order->id,
            'client_name' => $order->client_name,
            'status' => $order->status,
            'total' => $order->total,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
            'items' => $order->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'description' => $item->description,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                ];
            })->toArray(),
        ];
    }
}
