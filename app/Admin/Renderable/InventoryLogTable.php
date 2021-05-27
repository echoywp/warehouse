<?php
namespace App\Admin\Renderable;

use App\Models\InventoryLog;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class InventoryLogTable extends LazyRenderable
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function grid(): Grid
    {
        return Grid::make(new InventoryLog(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc')->whereInventoryId($this->payload['id']);
            $grid->column('user');
            $grid->column('type', trans('操作类型'))->using([
                1 => '新增',
                2 => '入库',
                3 => '出库',
                4 => '变迁',
            ])->label([
                1 => 'primary',
                2 => 'warning',
                3 => 'success',
                4 => 'danger',
            ]);
            $grid->column('column_trans', '库存类型');
            $grid->column('num', '操作数量');
            $grid->column('created_at');
            $grid->withBorder();
            $grid->disableToolbar();
            $grid->disableRowSelector();
            $grid->paginate(8);
//            $grid->disablePagination();
            $grid->disableActions();
            $grid->addTableClass(['table-text-center']);
        });
    }
}
