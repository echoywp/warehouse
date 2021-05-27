<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class InventoryLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'inventory_log';
    protected $fillable = ['type', 'column', 'user', 'num', 'module', 'inventory_id', 'product_id',];
    protected $appends = ['column_trans'];

    public static $column_trans = [
        'available_inventory' => '可用库存',
    ];

    public function getColumnTransAttribute() {
        if ($this->attributes['column']) {
            return self::$column_trans[$this->attributes['column']] ?? '未知';
        }
    }

    /**
     * @param int $type 1新增产品，2入库，3出库，4变迁
     * @param int $inventory_id
     * @param int $product_id
     * @param string $column
     * @param int $num
     * 记录操作日志
     */
    public static function log(int $type, int $inventory_id, int $product_id, string $column = '', int $num = 0) {
        switch ($type) {
            case 1:
            case 4:
                self::create([
                    'type' => $type,
                    'inventory_id' => $inventory_id,
                    'product_id' => $product_id,
                    'user' => Admin::user()->name
                ]);
                break;
            case 2:
            case 3:
                self::create([
                    'type' => $type,
                    'inventory_id' => $inventory_id,
                    'product_id' => $product_id,
                    'user' => Auth::user()->name,
                    'column' => $column,
                    'num' => $num
                ]);
        }
    }
}
