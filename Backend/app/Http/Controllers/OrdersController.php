<?php

namespace App\Http\Controllers;

use App\Application\Orders\Queries\ListOrders\ListOrdersHandler;
use App\Application\Orders\Queries\ListOrders\ListOrdersQuery;
use App\Application\Orders\Commands\CreateOrder\CreateOrderCommand;
use App\Application\Orders\Commands\CreateOrder\CreateOrderHandler;
use App\Application\Orders\Commands\AdvanceOrder\AdvanceOrderCommand;
use App\Application\Orders\Commands\AdvanceOrder\AdvanceOrderHandler;
use App\Application\Orders\Queries\GetOrder\GetOrderQuery;
use App\Application\Orders\Queries\GetOrder\GetOrderHandler;
use App\Http\Requests\CreateOrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Redis\RedisManager;

class OrdersController extends Controller
{
    public function list(ListOrdersHandler $handler): JsonResponse
    {
        $query = new ListOrdersQuery();
        $orders = $handler->handle($query);
        return response()->json($orders);
    }


    public function create(CreateOrderRequest $request, CreateOrderHandler $handler)
    {
        $command = new CreateOrderCommand(
            $request->input('client_name'),
            $request->input('items', [])
        );

        $result = $handler->handle($command);

        return response()->json($result);
    }

    public function advance(int $id, AdvanceOrderHandler $handler): JsonResponse
    {
        $command = new AdvanceOrderCommand($id);
        $result = $handler->handle($command);
        return response()->json($result);
    }

    public function get(int $id, GetOrderHandler $handler): JsonResponse
    {
        $query = new GetOrderQuery($id);
        $order = $handler->handle($query);
        return response()->json($order);
    }
}
