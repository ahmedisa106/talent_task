<?php


use Illuminate\Http\JsonResponse;

if (!function_exists('final_response')) {
    /**
     * @param int $status
     * @param mixed $message
     * @param mixed $data
     * @param mixed $errors
     * @return JsonResponse
     */
    function final_response(int $status = 200, mixed $message = '', mixed $data = [], mixed $errors = []): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'errors' => $errors

        ], $status);
    }
}
