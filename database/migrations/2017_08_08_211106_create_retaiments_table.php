<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetaimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retaiments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, false);
            $table->integer('rsmile_id',false, false);
            $table->integer('amount', false, false);
            $table->integer('status', false, false);
            $table->rememberToken();
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
        Schema::dropIfExists('retaiments');
    }
}
