<?php

namespace App\Traits;

trait Response
{
    // response with all data needed
    public function successResponse($data, $message = "", $code = 200)
    {
        return response()->json([
            "message" => $message,
            "content" => $data
        ], status: $code);
    }

    // sismple response with only a message

    public function easyResponse($message, $code = 200)
    {
        return response()->json([
            "message" => $message,
        ],$code);
        
    }

    public function noData($message, $code = 404)
    { 
        return response()->json(
            [
                "message" => $message,
                
            ], $code);
    }

    //
    public function errorResponse($message, $code = 500)
    {
        return response()->json([
            "message" => $message,
        ], $code);
    }
}
