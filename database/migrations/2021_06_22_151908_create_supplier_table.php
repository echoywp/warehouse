<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40)->default('')->comment('供应商名称');
            $table->string('contract_person', 30)->default('')->comment('联系人');
            $table->string('mobile', 20)->default('')->comment('电话');
            $table->string('address', 60)->default('')->comment('地址');
            $table->tinyInteger('settlement')->default(1)->comment('结算方式;1现金,2微信,3支付宝');
            $table->tinyInteger('status')->default('1')->comment('状态;1启用,2禁用');
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
        Schema::dropIfExists('supplier');
    }
}
