<?php

namespace App\Helpers;


use Illuminate\Http\JsonResponse;

class ApiResponseHelpers
{

    public static function successResponseJson($status, $message, $data = [], $code = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return new JsonResponse($response, $code);
    }

    public static function errorResponseJson($status, $message, $code = 500)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        return new JsonResponse($response, $code);
    }
}
