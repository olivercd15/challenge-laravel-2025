<?php
namespace App\Application\Orders\Commands\AdvanceOrder;

class AdvanceOrderCommand
{
    public function __construct(public int $orderId) {}
}
