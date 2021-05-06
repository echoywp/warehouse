<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'inventory';

    public function warehouse() {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function log() {
        $this->hasMany(InventoryLog::class, 'id', 'inventory_id');
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public static function booted(){
        static::created(function ($inventory) {
            InventoryLog::log(1, '新增产品', $inventory->id, $inventory->product_id);
        });
    }
}
