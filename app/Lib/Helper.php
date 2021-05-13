<?php

if(!function_exists('response')) {
    function response($message, $type = 'success') {
        return response()->json(['status' => true, 'data' => [
            'type' => 'warning',
            'message' => '此分类下还有相关产品，暂不可删除！'
        ]]);
    }
}

if (!function_exists('createProductCard')) {
    function createProductCard ($product) {
        $font = resource_path('fonts/msyh.ttc');
        $myImage = imagecreate(500, 300); //参数为宽度和高度
        imagecolorallocate($myImage, 173, 173, 173);
        $black = imagecolorallocate($myImage, 20, 20, 20);
//        $str = mb_convert_encoding('果冻1Elvis', "html-entities", "utf-8");
        // 边框
        imageline($myImage, 10, 10, 490, 10, $black);
        imageline($myImage, 10, 10, 10, 290, $black);
        imageline($myImage, 490, 10, 490, 290, $black);
        imageline($myImage, 10, 290, 490, 290, $black);
        // 表格
        imageline($myImage, 10, 50, 490, 50, $black);
        imagettftext($myImage, 14, 0, 220, 38, $black, $font, '产品卡');
        // 中间分隔线
        imageline($myImage, 248, 50, 248, 290, $black);
        // QrCode::format('png')
//        imagecopymerge($dst, $src, 114, 243, 0, 0, $src_w, $src_h, 100);
        imagepng($myImage, 'productCard/'.$product->id.'.jpg');
        ob_end_clean();
    }
}
