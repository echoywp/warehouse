<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->default('')->comment('仓库名称');
            $table->string('address', 50)->default('')->comment('仓库地址');
            $table->string('mobile', 20)->default('')->comment('联系电话');
            $table->string('contact_person', 20)->default('')->comment('联系人');
            $table->decimal('area', 8, 2)->default(0)->comment('仓库面积(M²)');
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
        Schema::dropIfExists('warehouse');
    }
}
