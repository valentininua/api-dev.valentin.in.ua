<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

class WebController extends Controller
{
/**
 * @OA\Get(
 *     path="/",
 *     operationId="welcome",
 *     summary="Welcome",
 *     description="Welcome",
 *     tags={"System"},
 *     @OA\Response(
 *         response=200,
 *         description="Welcome",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="welcome",
 *                 type="string",
 *                 example="Welcome"
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
public function welcome(): JsonResponse
{
    return response()->json([
        'welcome' => 'Welcome',
        'timestamp' => now()->toDateTimeString(),
    ]);
}
}
