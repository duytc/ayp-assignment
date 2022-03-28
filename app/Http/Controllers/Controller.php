<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function checkDbConnection(): JsonResponse
    {
        return response()->json([
            'data' => [
                'dbConnection' => !!DB::getPdo(),
            ]
        ]);
    }
}
