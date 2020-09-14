<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key_name')->nullable();
            $table->string('key_label')->nullable();
            $table->text('key_value')->nullable();
            $table->enum('key_type',['input','textarea','file','color','radio','password','dropdown']);
            $table->text('key_description')->nullable();
            $table->integer('key_display_order');
            $table->enum('master_configuration_type',['branding','letter_head','email','ui','calender']);
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
        Schema::dropIfExists('master_settings');
    }
}
