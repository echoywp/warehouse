<?php
namespace App\services;

use  SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductCardService {

    protected $font;

    protected $canvas;

    protected $black;

    protected $path;

    protected $qrCodePath;

    public function __construct(){
        $this->font = resource_path('fonts/msyh.ttc');
        $this->canvas = imagecreatefromstring(file_get_contents(resource_path('images/product-card-template.png')));
        $this->black = imagecolorallocate($this->canvas, 60, 60, 60);
    }

    /**
     * @param $product
     * @return string
     * 生成产品卡
     */
    public function createCard($product) {
        $this->path = 'productCard/'. $product->id .'.jpg';
        imagettftext($this->canvas, 18, 0, 60, 89, $this->black, $this->font, '名 称：' . $product->name);
        $specifications = '规 格（CM）：'.$product->length . ' * ' . $product->width . ' * ' . $product->height;
        imagettftext($this->canvas, 18, 0, 60, 201, $this->black, $this->font, $specifications);
        imagettftext($this->canvas, 18, 0, 60, 313, $this->black, $this->font, '重 量（G）：' . $product->weight);
        imagettftext($this->canvas, 18, 0, 60, 425, $this->black, $this->font, '分 类：' . $product->category_trans);
        $this->getQrCode($product->id);
        $qrCode = imagecreatefrompng( $this->qrCodePath);
        imagecopyresampled($this->canvas, $qrCode, 670, 50, 0, 0,400,400,imagesx($qrCode), imagesy($qrCode));
        imagejpeg($this->canvas, public_path($this->path));
        return '/' . $this->path;
    }

    /**
     * @param $id
     * 生成二维码
     */
    protected function getQrCode($id) {
        $url = config('app.url') . 'product/' . $id;
        if(!file_exists(public_path('qrcodes'))) mkdir(public_path('qrcodes'));
        $this->qrCodePath = public_path('qrcodes/'. $id .'.png');
        QrCode::format('png')->size(400)->generate($url, $this->qrCodePath);
    }
}
