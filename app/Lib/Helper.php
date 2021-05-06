<?php

if(!function_exists('response')) {
    function response($message, $type = 'success') {
        return response()->json(['status' => true, 'data' => [
            'type' => 'warning',
            'message' => '此分类下还有相关产品，暂不可删除！'
        ]]);
    }
}
