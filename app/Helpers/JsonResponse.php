<?php

namespace App\Helpers;

class JsonResponse
{
    /**
     * Respond JSON for success case.
     *
     * @param array $data
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = [], $status = 200, array $headers = [])
    {
        $responseArray = [
            'data'    => $data,
        ];

        return response()->json($responseArray, $status, $headers, JSON_UNESCAPED_SLASHES);
    }

    /**
     * Respond JSON for error case.
     *
     * @param $error
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($errorMessage, $errorName, $status = 400, array $headers = [])
    {
        $responseArray = [
            'code' => $status,
            'name' => $errorName,
            '$message'   => $errorMessage,
        ];

        return response()->json($responseArray, $status, $headers, JSON_UNESCAPED_SLASHES);
    }
}
