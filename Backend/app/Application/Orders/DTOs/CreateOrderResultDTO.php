<?php

namespace App\Application\Orders\DTOs;

class CreateOrderResultDTO
{
    public function __construct(
        public readonly int $orderId,
        public readonly string $clientName,
        public readonly string $status
    ) {}
}
