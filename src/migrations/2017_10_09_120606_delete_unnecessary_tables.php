<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUnnecessaryTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        if(Schema::hasTable('admin__sections')){
            Schema::drop('admin__sections');
        }
        if(Schema::hasTable('permissions')){
            Schema::dropIfExists('permissions');
        }
        if(Schema::hasTable('permission_role')){
            Schema::dropIfExists('permission_role');
        }
        if(Schema::hasTable('permission_user')){
            Schema::dropIfExists('permission_user');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
