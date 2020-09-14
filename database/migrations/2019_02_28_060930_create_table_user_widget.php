<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserWidget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_widget', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('widget_id')->unsigned();
            $table->enum('user_widget_status',['active','inactive'])->default('inactive');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('widget_id')->references('id')->on('widgets')->onUpdate('cascade');
      
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
        Schema::dropIfExists('user_widget');
    }
}
