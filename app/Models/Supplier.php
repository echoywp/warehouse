<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Base
{
    protected $table = 'supplier';

    public static $settlement = [
        1 => '现金',
        2 => '微信',
        3 => '支付宝'
    ];

    public static $settlement_color = [
        1 => 'warning',
        2 => 'primary',
        3 => 'success',
    ];

    public static function selector() {
        return self::whereStatus(1)->pluck('name', 'id')->toArray();
    }

}
