<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'product';

    public static $unit = [
        1 => '个',
        2 => '根',
        3 => '桶',
        4 => '瓶',
    ];

    public function getUnitAttribute($value) {
        return self::$unit[$value];
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
