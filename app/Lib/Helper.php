<?php

if(!function_exists('responseJson')) {
    function responseJson($code, $message, $type = 'success', $data = []) {
        return response()->json([
            'code' =>  $code,
            'type' => $type,
            'message' => $message,
            'data' => ''
        ]);
    }
}
