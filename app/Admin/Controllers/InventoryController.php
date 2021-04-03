<?php

namespace App\Admin\Controllers;

use App\Models\Inventory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class InventoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Inventory(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('warehouse_id');
            $grid->column('product_id');
            $grid->column('available_inventory');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Inventory(), function (Show $show) {
            $show->field('id');
            $show->field('warehouse_id');
            $show->field('product_id');
            $show->field('available_inventory');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Inventory(), function (Form $form) {
            $form->display('id');
            $form->text('warehouse_id');
            $form->text('product_id');
            $form->text('available_inventory');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
