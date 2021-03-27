<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Logistics extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'logistics';
}
