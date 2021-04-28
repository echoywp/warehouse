<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'product_log';

    protected $fillable = ['type', 'product_id', 'content', 'user_id'];

    public function user() {
        return $this->hasOne(AdminUser::class, 'id', 'user_id');
    }

    /**
     * @param int $type
     * @param int $product_id
     * @param string $content
     * 记录操作日志
     */
    public static function log(int $type, int $product_id, string $content) {
        self::create([
            'type' => $type,
            'product_id' => $product_id,
            'content' => $content,
            'user_id' => Admin::user()->id
        ]);
    }
}
