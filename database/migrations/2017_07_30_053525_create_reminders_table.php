<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reminder_user_id')->unsigned();
            $table->integer('document_id')->nullable(); //don't use foreign key as it cud be null in some cases
            $table->enum('document_type', ['incoming', 'outgoing', 'digitized','general'])->default('general');
            $table->date('reminder_date');
            $table->string('reminder_title');
            $table->text('reminder_content');
            $table->enum('reminder_type', ['email', 'sms', 'both'])->default('email');
            $table->date('reminder_snooze_date')->nullable();
            $table->string('reminder_to_email')->nullable();
            $table->enum('reminder_stack_holder', ['yes', 'no'])->default('no');//remind related to the document
            $table->enum('remind_to_all', ['yes', 'no'])->default('no');//remind to all the user presented in dms
            $table->date('deleted_at')->nullable();
            $table->foreign('reminder_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('dms_reminders');
    }
}
