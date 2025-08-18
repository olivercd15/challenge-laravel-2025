<?php

namespace App\Http\Swagger\Orders;

/**
 * @OA\Post(
 *     path="/api/orders",
 *     tags={"Orders"},
 *     summary="Create orders",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="client_name", type="string", example="Jose Mendoza"),
 *             @OA\Property(
 *                 property="items",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="description", type="string", example="Ceviche"),
 *                     @OA\Property(property="quantity", type="integer", example=1),
 *                     @OA\Property(property="unit_price", type="number", format="float", example=60)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Create order successful!",
 *         @OA\JsonContent(
 *             @OA\Property(property="orderId", type="integer"),
 *             @OA\Property(property="clientName", type="string"),
 *             @OA\Property(property="status", type="string", example="initiated")
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
class CreateOrderAnnotations {}
