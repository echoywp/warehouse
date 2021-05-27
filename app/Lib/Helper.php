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

if (!function_exists('makeDir')) {
    function makeDir($path) {
        if (!file_exists($path)) {
            mkdir($path);
        }
    }
}
