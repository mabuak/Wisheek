<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selectors', function (Blueprint $table) {
<<<<<<< HEAD
            $table->string('store')->primary();
=======
            $table->string('url')->primary();
>>>>>>> origin/master
            $table->string('selector');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function selectors()
    {
        Schema::drop('notifications');
    }
}
