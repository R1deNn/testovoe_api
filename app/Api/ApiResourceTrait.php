<?php

namespace App\Api;

use Illuminate\Http\JsonResponse;

trait ApiResourceTrait
{
    protected function errorResponse(string $message, int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'error' => $message,
        ], $code);
    }
}
