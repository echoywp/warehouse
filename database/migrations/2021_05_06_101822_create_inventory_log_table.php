<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_log', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default('1')->comment('操作类型；1：建库，2：增补，3：减耗，4：转仓');
            $table->string('column', 30)->default('')->comment('库存类');
            $table->integer('user_id')->default('0')->comment('操作人');
            $table->integer('num')->default(0)->comment('数量');
            $table->string('module', 30)->default('')->comment('模块');
            $table->integer('inventory_id')->default('0')->comment('库存ID');
            $table->integer('product_id')->default('0')->comment('产品ID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warehouse_log');
    }
}
