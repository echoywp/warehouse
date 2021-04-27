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
Form::resolving(function (Form $form) {
    $form->disableEditingCheck();

    $form->disableCreatingCheck();

    $form->disableViewCheck();

    $form->tools(function (Form\Tools $tools) {
        $tools->disableDelete();
        $tools->disableView();
    });

});
app('view')->prependNamespace('admin', resource_path('views/admin'));

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
