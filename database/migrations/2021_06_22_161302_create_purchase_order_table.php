<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_no', 20)->default('')->comment('采购单号');
            $table->tinyInteger('status')->default('2')->comment('状态');
            $table->tinyInteger('approve_status')->default('2')->comment('审核状态');
            $table->integer('supplier_id')->default('0')->comment('供应商ID');
            $table->integer('create_user')->default('0')->comment('创建人');
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
        Schema::dropIfExists('purchase_order');
    }
}
