<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designations')
                ->onUpdate('cascade');
            $table->integer('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments')
                ->onUpdate('cascade');
            $table->integer('user_group_id')->unsigned();
            $table->foreign('user_group_id')->references('id')->on('user_groups')
                ->onUpdate('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_image')->nullable();
            $table->string('user_signature')->nullable();
            $table->enum('user_signature_allow_other',['true','false'])->default('false');
            $table->string('user_signature_content')->nullable();
            $table->enum('user_status',['active','inactive'])->default('active');
            $table->timestamp('last_online')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
