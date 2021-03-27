<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->default('')->comment('产品名称');
            $table->string('desc', 120)->default('')->comment('产品描述');
            $table->integer('category_id')->default(0)->comment('产品分类');
            $table->tinyInteger('unit')->default(0)->comment('产品单位');
            $table->decimal('length', 11, 2)->default(0)->comment('长（CM）');
            $table->decimal('width', 11, 2)->default(0)->comment('宽（CM）');
            $table->decimal('height', 11, 2)->default(0)->comment('高（CM）');
            $table->decimal('weight', 11, 2)->default(0)->comment('重量（G）');
            $table->decimal('price', 11, 2)->default(0)->comment('采购价');
            $table->tinyInteger('status')->default(1)->comment('状态');
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
        Schema::dropIfExists('product');
    }
}
