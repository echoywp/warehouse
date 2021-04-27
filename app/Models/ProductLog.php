<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'product_log';

    public function log(int $type, int $product_id) {
        $data = [
            'type' => $type,
            'product_id' => $product_id,
            'content' => ''
        ];
        self::created($data);
    }
}
