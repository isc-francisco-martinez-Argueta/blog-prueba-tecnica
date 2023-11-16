<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message, $code = 200) : JsonResponse
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }

    public function sendError($error, $errorMessages = [], $code = 404) : JsonResponse
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function sendException($exception, $errorMessage = "", $code = 403) : JsonResponse
    {
    	$response = [
            'success' => false,
            'message' => $exception,
        ];

        if(!empty($errorMessage)){
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}
