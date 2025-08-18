<?php
namespace App\Application\Orders\Commands\AdvanceOrder;

use App\Domain\Interfaces\OrderRepositoryInterface;

class AdvanceOrderHandler
{
    public function __construct(private OrderRepositoryInterface $orderRepository) {}

    public function handle(AdvanceOrderCommand $command): array
    {
        $order = $this->orderRepository->getOrder($command->orderId);

        if (!$order) {
            return ['error' => 'Order not found'];
        }

        $previousStatus = $order->status;

        $newStatus = $this->getNextStatus($previousStatus);

        $result = $this->orderRepository->advanceOrder($command->orderId, $newStatus);

        $this->orderRepository->createOrderStatusLog($command->orderId, [
            'previous_status' => $previousStatus,
            'new_status'     => $newStatus,
        ]);

        if ($newStatus === 'deleted') {
            $this->orderRepository->deleteOrder($command->orderId);
            return [
                'id' => $command->orderId,
                'status' => 'deleted',
                'message' => 'Order delivered and removed!'
            ];
        }

        return $result;
    }

    private function getNextStatus(string $currentStatus): string
    {
        $transitions = [
            'initiated' => 'sent',
            'sent'      => 'delivered',
            'delivered' => 'deleted',
        ];

        return $transitions[$currentStatus];
    }
}
