<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_email_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('sender_user_id')->unsigned();
            $table->enum('email_send_status',['success','failed']);
            $table->integer('email_logs_document_id')->nullable();
            $table->enum('email_received_acknowledgement',['success','failed']);
            $table->date('email_received_acknowledgement_date')->nullable();
            $table->enum('email_logs_document_type',['incoming','outgoing','digitized']);
            $table->string('email_logs_address')->nullable();
            $table->date('email_logs_sent_date');
          
            /*
             * define 'sender_user_id' on relationships
             */
            $table->foreign('sender_user_id')->references('id')->on('users')->onUpdate('cascade');


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
        Schema::dropIfExists('dms_email_logs');
    }
}
