<?php

namespace App\Http\Swagger\Orders;

/**
 * @OA\Get(
 *     path="/api/orders/{id}",
 *     tags={"Orders"},
 *     summary="Get detail order",
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             @OA\Property(property="id", type="integer"),
 *             @OA\Property(property="client_name", type="string"),
 *             @OA\Property(property="status", type="string"),
 *             @OA\Property(property="total", type="string"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time"),
 *             @OA\Property(
 *                 property="items",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer"),
 *                     @OA\Property(property="description", type="string"),
 *                     @OA\Property(property="quantity", type="integer"),
 *                     @OA\Property(property="unit_price", type="string")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Data error"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error"
 *     )
 * )
 */
class GetOrderDetailAnnotations {}
