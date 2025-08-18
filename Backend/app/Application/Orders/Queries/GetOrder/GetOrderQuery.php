<?php
namespace App\Application\Orders\Queries\GetOrder;

class GetOrderQuery
{
    public function __construct(public int $orderId) {}
}
