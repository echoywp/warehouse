<?php

namespace App\Models;

use Dcat\Admin\Admin;
use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'inventory_log';

    public function user() {
        return $this->hasOne(AdminUser::class, 'id', 'user_id')->select('id', 'name');
    }

    /**
     * @param int $type
     * @param string $module
     * @param int $inventory_id
     * @param int $product_id
     * @param string $column
     * @param int $num
     * 记录操作日志
     */
    public static function log(int $type, string $module, int $inventory_id, int $product_id, string $column = '', int $num = 0) {
        switch ($type) {
            case 1:
                self::create([
                    'type' => $type,
                    'module' => $module,
                    'inventory_id' => $inventory_id,
                    'product_id' => $product_id,
                    'user_id' => Admin::user()->id
                ]);
                break;
            case 2 || 3 || 4:
                break;
        }
    }
}
