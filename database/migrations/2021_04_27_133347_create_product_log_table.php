<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_log', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default(1)->comment('操作类型；1：新增，2：修改，3：删除');
            $table->integer('product_id')->default(0)->comment('产品ID');
            $table->integer('user_id')->default(0)->comment('操作人');
            $table->text('content')->comment('操作内容');
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
        Schema::dropIfExists('product_log');
    }
}
