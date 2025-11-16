<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data): JsonResponse
    {
        return response()->json([
            'status_code' => 200,
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public static function error($message, $code): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message
        ], $code);
    }

    public static function unauthorized(): JsonResponse
    {
        return response()->json([
            'status_code' => 401,
            'message' => 'Unauthorized access'
        ], 401);
    }
}