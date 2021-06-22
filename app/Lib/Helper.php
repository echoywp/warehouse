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

if (!function_exists('createNo')) {
    function createNo($prefix = 'YY') {
        return $prefix . date('YmdHis') . rand(1000,9999);
    }
}

if (!function_exists('reviewImg')) {
    function reviewImg($type = '', $value = 0) {
        $url = config('app.url');
        $path = [
            'approve_status' => [
                2 => $url . 'images/approve-2.png',
                1 => $url . 'images/approve-3.png',
            ],
        ];
        if (!array_key_exists($type, $path) || !array_key_exists($value, $path[$type])) {
            return false;
        }
        return  $path[$type][$value];
    }
}
