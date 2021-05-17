<?php
namespace App\services;

class ProductCardService {

    protected $font;

    protected $canvas;

    protected $black;

    public function __construct(){
        $this->font = resource_path('fonts/msyh.ttc');
        $this->canvas = imagecreate(400, 300);
        imagecolorallocate($this->canvas, 255, 255, 255);
        $this->black = imagecolorallocate($this->canvas, 20, 20, 20);
    }

    public function createCard($product) {

//        $qrCode = $this->getQrCode($product);
//        list($src_w, $src_h) = getimagesize($qrCode);
        // 边框
        imageline($this->canvas, 10, 10, 490, 10, $this->black);
        imageline($this->canvas, 10, 10, 10, 290, $this->black);
        imageline($this->canvas, 490, 10, 490, 290, $this->black);
        imageline($this->canvas, 10, 290, 490, 290, $this->black);
        // 表格
        imageline($this->canvas, 10, 50, 490, 50, $this->black);
        imagettftext($this->canvas, 14, 0, 220, 38, $this->black, $this->font, '产品卡');
        // 中间分隔线
        imageline($this->canvas, 248, 50, 248, 290, $this->black);
        imagettftext($this->canvas, 14, 0, 220, 20, $this->black, $this->font, '这是标题');
        imagejpeg($this->canvas, public_path('productCard/'. $product->id . '.jpg'));
        ob_end_clean();
    }

    protected function getQrCode($product) {
        $src_path = resource_path('images/t.jpg');
        return imagecreatefromstring(file_get_contents($src_path));
        return 1;
    }
}
