<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    // 产品列表
    $router->resource('product', 'ProductController');
    // 产品分类
    $router->resource('category', 'CategoryController');

    // 仓库列表
    $router->resource('warehouse', 'WarehouseController');
    // 库存列表
    $router->resource('inventory', 'InventoryController');

    // 物流信息
    $router->resource('logistics', 'LogisticsController');

    // 系统配置
    $router->resource('common', 'CommonController');

    // 员工管理
    $router->resource('user', 'UserController');

    /**
     * 采购管理
     */
    // 供应商管理
    $router->resource('supplier', 'SupplierController');
    // 采购单
    $router->resource('purchase-order', 'PurchaseOrderController');
});
