<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 30)->default('')->comment('运单号');
            $table->integer('type')->comment('类型');
            $table->integer('channel')->comment('渠道');
            $table->string('destination', 50)->default('')->comment('目的地');
            $table->integer('user_id')->comment('发起人');
            $table->string('order_number', 50)->comment('订单号');
            $table->date('arrival_date')->comment('到货时间');
            $table->integer('status')->default(1)->comment('状态');
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
        Schema::dropIfExists('logistics');
    }
}
