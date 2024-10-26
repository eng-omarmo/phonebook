<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data = null, $message = 'Operation successful', $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param int $code
     * @param mixed $data
     * @return JsonResponse
     */
    public function errorResponse($message = 'Operation failed', $code = 500, $data = null): JsonResponse
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    /**
     * Return a validation error JSON response.
     *
     * @param mixed $errors
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function validationErrorResponse($errors = [], $message = 'Validation errors', $code = 422): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }


    /**
     * Return a server error JSON response.
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function serverErrorResponse($message = 'Server error', $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $code);
    }
}
