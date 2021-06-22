<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
	use HasDateTimeFormatter;

	public static $status = [
	    1 => '启用',
	    2 => '禁用'
    ];

}
