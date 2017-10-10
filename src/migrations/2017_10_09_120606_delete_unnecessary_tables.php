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
        if(Schema::hasTable('admin__sections')){
            Schema::drop('admin__sections');
        }
        if(Schema::hasTable('permissions')){
            Schema::drop('permissions');
        }
        if(Schema::hasTable('permission_role')){
            Schema::drop('permission_role');
        }
        if(Schema::hasTable('permission_user')){
            Schema::drop('permission_user');
        }
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
