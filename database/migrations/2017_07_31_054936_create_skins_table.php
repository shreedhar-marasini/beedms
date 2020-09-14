<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('skin_name');
            $table->enum('fixed_layout',['yes','no']);
            $table->enum('boxed_layout',['yes','no']);
            $table->enum('toggle_sidebar',['yes','no']);
            $table->enum('sidebar_expand_on_hover',['yes','no']);
            $table->enum('toggle_right_sidebar_slide',['yes','no']);
            $table->enum('toggle_right_sidebar_skin',['yes','no']);
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
        Schema::dropIfExists('skins');
    }
}
