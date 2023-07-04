<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HasErrorResponse
{
    public function error(string $message = 'Error!! try again later.', array $data = [], int $status = 500): JsonResponse
    {
        return new \Illuminate\Http\JsonResponse(['data' => $data, 'message' => $message], $status);
    }
}
