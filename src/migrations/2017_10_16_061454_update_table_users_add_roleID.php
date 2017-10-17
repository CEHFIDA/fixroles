<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUsersAddRoleID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        if(Schema::hasTable('role_user')){
        	Schema::drop('role_user');
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        if(!Schema::hasColumn('users', 'role_id')){
            Schema::table('users', function (Blueprint $table) {
                $table->tinyInteger('role_id')->default(null)->after('email');
            });
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
