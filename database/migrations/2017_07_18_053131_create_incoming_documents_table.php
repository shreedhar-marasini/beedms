<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_incoming_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_institution_id')->unsigned();
            $table->integer('receiver_department_id')->unsigned();
            $table->integer('document_category_id')->unsigned();
            $table->integer('uploaded_by_user_id')->unsigned();
            $table->string('sender_department_name')->nullable();
            $table->string('issue_number');
            $table->date('issue_date');
            $table->date('document_received_date');
            $table->string('incoming_document_subject')->nullable();
            $table->string('incoming_document_registration_number');
            $table->integer('incoming_serial_number')->nullable();
            $table->date('incoming_document_registration_date');
            $table->string('incoming_document_upload')->nullable();
            $table->string('incoming_document_additional_uploads')->nullable();
            $table->enum('incoming_document_privacy',['Confidential','Departmental','General']);
//            $table->date('incoming_document_reminder_date');
//            $table->string('incoming_document_reminder_content')->nullable();
            $table->date('deleted_at')->nullable();
            $table->foreign('sender_institution_id')->references('id')->on('dms_institutions')->onupdate('cascade');
            $table->integer('folder_id');
            /*
           * define "receiver_department_id" in relationship
           */
            $table->foreign('receiver_department_id')->references('id')->on('departments')->onupdate('cascade');
            /*
            * define "document_category_id" in relationship
            */
            $table->foreign('document_category_id')->references('id')->on('dms_document_categories')->onupdate('cascade');
            /*
             * define "uploaded_by_user_id" in relationship
             */
            $table->foreign('uploaded_by_user_id')->references('id')->on('users')->onupdate('cascade');




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
        Schema::dropIfExists('dms_incoming_documents');
    }
}
