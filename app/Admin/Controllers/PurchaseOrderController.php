<?php

namespace App\Admin\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PurchaseOrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new PurchaseOrder(), function (Grid $grid) {
            $grid->column('purchase_no');
            $grid->column('status');
            $grid->column('approve_status');
            $grid->column('supplier_id');
            $grid->column('create_user');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('purchase_no');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new PurchaseOrder(), function (Form $form) {
            $purchaseNo = createNo('CG');
            $form->row(function (Form\Row $form) use($purchaseNo)  {
                $form->width(4)->text('purchase_no')->default($purchaseNo)->disable();
                $form->width(4)->select('supplier_id')->options(Supplier::selector());
                $form->hidden('status')->default(2);
                $form->hidden('approve_status')->default(2);
                $form->reviewIcon('approve_status', 2);
            });
            $form->saving(function (Form $form) use($purchaseNo) {
                if ($form->isCreating()) {
                    $form->purchase_no = $purchaseNo;
                }
            });
        });
    }
}
