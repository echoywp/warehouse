<?php
namespace App\Admin\Renderable;

use App\Models\ProductLog;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class ProductLogTable extends LazyRenderable
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function grid(): Grid
    {
        return Grid::make(new ProductLog(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc')->whereProductId($this->payload['id'])->with('user')->limit(6);
            $grid->column('user.name', trans('操作人'));
            $grid->column('content', trans('修改内容'))->display(function ($value) {
                return $value;
            });
            $grid->column('created_at');
            $grid->withBorder();
            $grid->disableToolbar();
            $grid->disableRowSelector();
            $grid->disablePagination();
            $grid->disableActions();
            $grid->addTableClass(['table-text-center']);
        });
    }
}
