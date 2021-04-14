<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasDateTimeFormatter, ModelTree;

    protected $table = 'category';

    protected $titleColumn = 'title';

    protected $orderColumn = 'sort';

    protected $parentColumn = 'parent_id';

    // 返回空值即可禁用 order 字段
    public function getOrderColumn()
    {
        return null;
    }

    /**
     * @param string $id
     * @return array
     * 下拉选项
     */
    public static function selector($id = '') {
        $categories = self::when($id, function ($sql) use ($id) {
            $sql->where('id', '!=', $id);
        })->get()->map(function ($item) {
            return [$item->id => $item->title];
        })->flatten()->toArray();
        return array_merge([0 => '顶级'], $categories);
    }
}
