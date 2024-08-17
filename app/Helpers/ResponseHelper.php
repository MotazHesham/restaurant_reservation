<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ResponseHelper
{
    public static function returnResource(JsonResource $resource, string $message, bool $status, $code): JsonResource
    {
        return $resource->additional([
            'message' => __($message),
            'status' => $status,
            'code' => $code,
        ]);
    }

    public static function returnResponse($data, string $message, bool $status, $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => __($message),
            'status' => $status,
            'code' => $code,
        ], $code);
    }
}