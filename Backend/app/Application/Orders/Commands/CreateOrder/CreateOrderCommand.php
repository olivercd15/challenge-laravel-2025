<?php

namespace App\Application\Orders\Commands\CreateOrder;

class CreateOrderCommand
{
    public function __construct(
        public readonly string $clientName,
        public readonly array $items
    ) {}
}
