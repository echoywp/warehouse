<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserInventoryLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_log', function (Blueprint $table) {
            //
            $table->dropColumn('user_id');
            $table->dropColumn('module');
            $table->string('user', 30)->default('')->comment('操作人')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_log', function (Blueprint $table) {
            //
        });
    }
}
