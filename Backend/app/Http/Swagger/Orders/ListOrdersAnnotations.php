<?php

namespace App\Http\Swagger\Orders;

/**
 * @OA\Get(
 *     path="/api/orders",
 *     tags={"Orders"},
 *     summary="List orders",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer", example=20),
 *                 @OA\Property(property="client_name", type="string", example="Carlos Gómez"),
 *                 @OA\Property(property="total", type="string", example="80.00"),
 *                 @OA\Property(property="status", type="string", example="initiated"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-18T10:20:09.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-18T10:20:09.000000Z")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Data error"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error "
 *     )
 * )
 */
class ListOrdersAnnotations {}
