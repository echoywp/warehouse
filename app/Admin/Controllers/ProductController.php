<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\ProductLogAction;
use App\Models\Inventory;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController
{

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Product(), function (Grid $grid) {
            $grid->model()->orderBy('id', 'desc');
            $grid->column('name');
            $grid->column('desc');
            $grid->column('category_trans', admin_trans_field('category_id'));
            $grid->column('unit_trans', admin_trans_field('unit'));
            $grid->column('length');
            $grid->column('width');
            $grid->column('height');
            $grid->column('weight');
            $grid->column('price');
            $grid->status()->switch();
            $grid->column('updated_at')->display(function ($value) {
                return substr($value, 0, 10);
            })->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->panel();
                $filter->like('name')->width(3);
                $filter->equal('status')->select(config('option.option.status'))->width(3);
            });

            $grid->export()->filename(trans('Product.labels.Product'))->rows(function (array $rows) {
                foreach ($rows as $index => &$row) {
                    $row['status'] = config('option.option.status')[$row['status']];
                }
                return $rows;
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(ProductLogAction::make()->setKey($actions->row->id));
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
        return Show::make($id, new Product(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('desc');
            $show->field('category_id');
            $show->field('unit');
            $show->field('length');
            $show->field('width');
            $show->field('height');
            $show->field('weight');
            $show->field('price');
            $show->field('status');
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
        return Form::make(new Product(), function (Form $form) {
            $form->column(6, function (Form $form) {
                $form->text('name')->required()->rules('max:20', config('option.rules'))
                    ->creationRules('unique:product,name', config('option.rules'))->updateRules('unique:product,name,{{id}}', config('option.rules'));
                $form->text('desc')->required()->rules('max:50', config('option.rules'));
                $form->tree('category_id')
                    ->nodes((new Category())->allNodes())
                    ->setTitleColumn('title')->required();
                $form->select('unit')->options(config('option.option.unit'))->required();
                if ($form->isEditing()) {
                    $form->multipleSelect('warehouse')->options(Warehouse::selector())->value($form->model()->getInventory()->pluck('id')->toArray())->disable();
                } else {
                    $form->multipleSelect('warehouse')->options(Warehouse::selector())->required();
                }
            });
            $form->column(6, function (Form $form) {
                $form->text('price')->required()->rules('numeric', config('option.rules'));
                $form->text('length')->required()->rules('numeric', config('option.rules'));
                $form->text('width')->required()->rules('numeric', config('option.rules'));
                $form->text('height')->required()->rules('numeric', config('option.rules'));
                $form->text('weight')->required()->rules('numeric', config('option.rules'));
            });
            $form->width(8, 3);
            $form->hidden('status')->customFormat(function ($v) {
                    return $v ? 1 : 0;
                })->saving(function ($v) {
                    return $v ? 1 : 0;
                })->default(1);
            $form->ignore(['warehouse']);
            $warehouse = $form->input('warehouse');
            $form->saved(function (Form $form, $id) use ($warehouse){
                if ($form->isCreating()) {
                    array_map(function ($item) use ($id) {
                        Inventory::create([
                            'product_id' => $id,
                            'warehouse_id' => $item,
                        ]);
//                        return array_merge($data, [
//                            'product_id' => $id,
//                            'warehouse_id' => $item,
//                            'created_at' => date('Y-m-d H:i:s'),
//                            'updated_at' => date('Y-m-d H:i:s'),
//                        ]);
                    }, array_filter($warehouse));
//                    Inventory::insert($data);
                }
            });
            $form->submitted(function (Form $form) {
                $category_id = $form->input('category_id');
                if($category_id && strpos($category_id, ',')) {
                    $form->responseValidationMessages('category_id', '分类不可多选');
                }
            });
        });
    }
}
