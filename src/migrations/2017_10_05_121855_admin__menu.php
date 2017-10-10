<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin__menu')) {
            Schema::create('admin__menu', function (Blueprint $table) {
            	$table->increments('id');
            	$table->string('title');
            	$table->string('package');
            	$table->integer('parent');
            	$table->integer('sort');
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
