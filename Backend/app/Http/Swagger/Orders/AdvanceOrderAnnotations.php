<?php

namespace App\Http\Swagger\Orders;

/**
 * @OA\Post(
 *     path="/api/orders/{id}/advance",
 *     tags={"Orders"},
 *     summary="Advance orders",
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
 *             type="array",
 *             @OA\Items(
 *                 @OA\Property(property="id", type="integer"),
 *                 @OA\Property(property="status", type="string"),
 *                 @OA\Property(property="message", type="string")
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
class AdvanceOrderAnnotations {}
