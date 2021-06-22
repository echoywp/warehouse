<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\ProductLogTable;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use App\services\ProductCardService;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Widgets\Modal;

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
            $grid->column('category_trans', admin_trans_field('category_id'))->label();
            $grid->status()->switch();
            $grid->column('unit_trans', admin_trans_field('unit'));
            $grid->column('length', '规格')->display(function () {
                return $this->length . '*' . $this->width . '*' . $this->height;
            });
            $grid->column('price');
            $grid->column('updated_at')->display(function ($value) {
                return substr($value, 0, 10);
            })->sortable();
            $grid->column('id', '货架卡')->display(function () {
                $product = Product::find($this->id);
                return app(ProductCardService::class)->createCard($product);
            })->image('/');

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
                $actions->append(
                    Modal::make()
                        ->lg()
                        ->title('日志')
                        ->body(ProductLogTable::make()->payload(['id' => $actions->row->id]))
                        ->button('查看日志'));
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
                $form->select('category_id')->options(Category::selectOptions());
                $form->select('unit')->options(config('option.option.unit'))->required();
                if ($form->isEditing()) {
                    $form->select('warehouse')->options(Warehouse::selector())->value($form->model()->getInventory()->warehouse_id)->disable();
                } else {
                    $form->select('warehouse')->options(Warehouse::selector())->required();
                }
            });
            $form->column(6, function (Form $form) {
                $form->text('price')->required()->rules('numeric', config('option.rules'));
                $form->text('length')->required()->rules('numeric', config('option.rules'));
                $form->text('width')->required()->rules('numeric', config('option.rules'));
                $form->text('height')->required()->rules('numeric', config('option.rules'));
                $form->text('weight')->required()->rules('numeric', config('option.rules'));
                $form->image('good_pic')->required()->uniqueName();
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
                    }, array_filter($warehouse));
                }
            });
            $form->submitted(function (Form $form) {
//                $category_id = $form->input('category_id');
//                if($category_id && strpos($category_id, ',')) {
//                    $form->responseValidationMessages('category_id', '分类不可多选');
//                }
            });
        });
    }
}
