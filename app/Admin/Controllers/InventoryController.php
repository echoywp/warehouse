<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\InventoryLogAction;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
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
            $grid->model()->with(['warehouse', 'product']);
            $grid->column('warehouse.name', trans('inventory.fields.warehouse_id'));
            $grid->column('product.name', trans('inventory.fields.product_id'));
            $grid->column('available_inventory');
            $grid->column('updated_at')->sortable();
            $grid->disableRowSelector();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('warehouse_id',  trans('inventory.fields.warehouse_id'))->select(Warehouse::selector());
                $filter->equal('product_id',  trans('inventory.fields.product_id'))->select(Product::selector());
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(InventoryLogAction::make()->setKey($actions->row->id));
                $actions->disableEdit();
                $actions->disableDelete();
                $actions->disableView();
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
            $form->select('warehouse_id')->options(Warehouse::selector());
            $form->select('product_id')->options(Product::selector());
            $form->text('available_inventory');
        });
    }
}
