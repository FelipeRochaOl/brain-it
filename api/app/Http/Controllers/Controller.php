<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    const LIMIT_PER_PAGE = 20;

    protected function createResponse(bool $success = false, $data, array $error = []): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'error' => (object) $error,
            'response' => $this->getValidData($data),
        ]);
    }

    private function getValidData($data)
    {
        if (!$this->validateDataType($data)) {
            return (object) [];
        }
        return (object) $data;
    }

    private function validateDataType($data)
    {
        return is_array($data) || is_object($data);
    }
}
