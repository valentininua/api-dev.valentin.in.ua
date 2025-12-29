<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class PingController extends Controller
{
/**
 * @OA\Get(
 *     path="/ping",
 *     operationId="ping",
 *     summary="Ping API",
 *     description="Проверка доступности API",
 *     tags={"System"},
 *     @OA\Response(
 *         response=200,
 *         description="API доступен",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="pong",
 *                 type="boolean",
 *                 example=true
 *             )
 *             @OA\Property(
 *                 property="timestamp",
 *                 type="string",
 *                 example="2025-12-30T00:00:00.000000Z"
 *             )
 *         )
 *     )
 * )
 */
public function ping(): JsonResponse
{
    return response()->json([
        'pong' => true,
        'timestamp' => now()->toDateTimeString(),
    ]);
}
}
