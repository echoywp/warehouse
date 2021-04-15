<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'product';

    protected $appends = ['unit_trans', 'category_trans'];

    protected $guarded = ['warehouse'];

    public static $unit = [
        1 => '个',
        2 => '根',
        3 => '桶',
        4 => '瓶'
    ];

    public function setCategoryIdAttribute($value) {
        $this->attributes['category_id'] = $value[0];
    }

    public function getUnitTransAttribute() {
        return self::$unit[$this->attributes['unit']];
    }

    public function getCategoryTransAttribute() {
        return $this->category->title;
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
