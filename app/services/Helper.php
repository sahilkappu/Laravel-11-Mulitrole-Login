<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Helper
{
    /**
     * Return Response on Success 
     * @param  [Integer] status_code
     * @param  [string] method
     * @return [string] message
     */
    public static function responseOnSuccess($data)
    {
        return response()->json([
            'success' => true,
            'status_code' => 200,
            'method' => $data['method'],
            'message' => $data['message'],
            'data' => $data['data']
        ]);
    }
    /**
     * Return Response on Validation Failure 
     * @param  [Integer] status_code
     * @param  [string] method
     * @return [string] message
     */
    public static function responseOnValidationFailure($data)
    {
        return response()->json([
            'success' => false,
            'status_code' => 422,
            'status' => "failure",
            'method' => 'POST',
            'message' => isset($data['message']) ? $data['message'] : 'Validation failed.',
            'data' => null
        ]);
    }
    /**
     * Return Response on Failure 
     * @param  [Integer] status_code
     * @param  [string] method
     * @return [string] message
     */

    public static function responseOnFailure($data = null, $statusCode = 400)
    {
        $message = isset($data['message']) ? $data['message'] : 'Something went wrong. Please try again.';

        return response()->json([
            'success' => false,
            'status_code' => $statusCode,
            'method' => 'POST',
            'message' => $message,
            'data' => null
        ], $statusCode);
    }
}
