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

    public static $fields = [
        'name',
        'desc',
        'category_id',
        'unit',
        'length',
        'width',
        'height',
        'weight',
        'price',
        'status'
    ];

    public static $unit = [
        1 => '个',
        2 => '根',
        3 => '桶',
        4 => '瓶'
    ];

    public function getInventory() {
        return Inventory::whereProductId($this->id)->get();
    }

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

    public static function booted() {
        static::created(function ($product) {
            ProductLog::log(1, $product->id, '新增');
        });
        static::updated(function ($product) {
            $content = '';
            foreach (self::$fields as $item) {
                if ($product->getOriginal($item) != $product->$item) {
                    $history =  $product->getOriginal($item);
                    $current = $product->$item;
                    if($item == 'unit') {
                        $history = self::$unit[$history];
                        $current = self::$unit[$current];
                    }
                    $content .= '【' . admin_trans('product.fields.'.$item) . '】由【'. $history .'】修改为【'. $current .'】'. "<br>";
                }
            }
            if (!empty($content)) {
                ProductLog::log(2, $product->id, $content);
            }
        });
    }
}
