<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'inventory';
    protected $fillable = ['warehouse_id', 'product_id', 'available_inventory'];

    public function warehouse() {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');
    }

    public function log() {
        $this->hasMany(InventoryLog::class, 'id', 'inventory_id');
    }

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    /**
     * @param $type 1:入库，2：出库
     * @param $product_id
     * @param $quantity
     * @param string $column
     * 库存变更
     */
    public static function changeInventory($type, $product_id, $quantity, $column) {
        $inventory = self::where('product_id', $product_id)->first();
        if ($type == 2) {
            $inventory->increment($column, $quantity);
        } else {
            $inventory->decrement($column, $quantity);
        }
        InventoryLog::log($type, $inventory->id, $product_id, $column, $quantity);
    }

    public static function booted(){
        static::created(function ($inventory) {
            InventoryLog::log(1, '新增产品', $inventory->id, $inventory->product_id);
        });
    }
}
