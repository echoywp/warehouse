<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
Filter::resolving(function (Filter $filter) {
    $filter->expand();
    $filter->panel();
});
Grid::resolving(function (Grid $grid) {
    $grid->setActionClass(Grid\Displayers\Actions::class);
    $grid->model()->orderBy('id', 'desc');
    $grid->disableViewButton();
    $grid->showQuickEditButton();
    $grid->enableDialogCreate();
    $grid->disableBatchDelete();
    $grid->actions(function (Grid\Displayers\Actions $actions) {
//        $actions->disableView();
//        $actions->disableDelete();
        $actions->disableEdit();
    });
    $grid->option('dialog_form_area', ['70%', '80%']);
});

Form::resolving(function (Form $form) {
    $form->disableEditingCheck();
    $form->disableCreatingCheck();

    $form->disableViewCheck();

    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableView();
    });
});
Form::extend('reviewIcon', \App\Admin\Extensions\Form\ReviewIcon::class);
// 替换模板
app('view')->prependNamespace('admin', resource_path('views/admin'));

// 配置管理
if (file_exists('upload/' . admin_setting('logo'))) {
    $logo = '<img src="/upload/' . admin_setting('logo') . '" width="35">&nbsp;' . admin_setting('company_name');
    $mini = '<img src="/upload/' . admin_setting('logo') . '" >';
} else {
    $logo = config('admin.logo');
    $mini = config('admin.logo-mini');
}
config([
    'admin.title' => admin_setting('web_name'),
    'admin.name' => admin_setting('company_name'),
    'admin.logo' => $logo,
    'admin.logo-mini' => $mini,
    'app.url' => admin_setting('url'),
    'app.VERSION' => admin_setting('version')
]);

// 双击弹框
//$script = <<<JS
//      $("#grid-table > tbody > tr").on("dblclick",function() {
//         var obj = $(this).find(".feather.icon-edit-1");
//         if (obj.length == 1) {
//             obj.trigger("click")
//         }
//      })
//JS;
//Admin::script($script);

