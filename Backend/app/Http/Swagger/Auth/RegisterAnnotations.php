<?php

namespace App\Http\Swagger\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/auth/register",
 *     tags={"Auth"},
 *     summary="Register",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password"},
 *             @OA\Property(property="name", type="string", example="John Click"),
 *             @OA\Property(property="email", type="string", example="user@example.com"),
 *             @OA\Property(property="password", type="string", example="123456")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Register successful!",
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string"),
 *             @OA\Property(property="status", type="integer")
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
class RegisterAnnotations {}
