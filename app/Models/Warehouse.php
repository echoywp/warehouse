<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'warehouse';

    /**
     * @return mixed
     */
    public static function selector() {
        return self::get()->map(function ($item) {
            return [$item->id => $item->name];
        })->flatten()->toArray();
    }
}
