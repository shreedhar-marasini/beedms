<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutgoingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_outgoing_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->unsigned();
            $table->integer('template_id')->unsigned();
            $table->integer('created_by_user_id')->unsigned();
            $table->integer('signature_user_id')->nullable();
            $table->string('department_name')->nullable();
            $table->string('outgoing_registration_number')->nullable();
            $table->date('outgoing_registration_date')->nullable();
            $table->date('outgoing_document_date');
            $table->string('outgoing_document_subject')->nullable();
            $table->text('outgoing_document_content')->nullable();
            $table->string('outgoing_file_uploads')->nullable();
            $table->enum('outgoing_document_privacy',['Confidential','Departmental','General']);
            $table->enum('outgoing_issue_status',['issued','draft','registered'],'issued');
            $table->date('outgoing_issue_date')->nullable();
            $table->integer('issued_by')->nullable();
            $table->string('outgoing_issue_number')->nullable();
            $table->date('reminder_email_send_date')->nullable();
            $table->integer('outgoing_serial_number')->nullable();
//            $table->date('outgoing_reminder_date')->nullable();
//            $table->string('outgoing_reminder_content')->nullable();
            $table->string('url_verification_key')->nullable();
            $table->integer('folder_id');
            $table->date('deleted_at')->nullable();
            $table->foreign('institution_id')->references('id')->on('dms_institutions')->onUpdate('cascade');
            $table->foreign('template_id')->references('id')->on('dms_templates')->onUpdate('cascade');
            /*
             * define 'created_by_user_id' on relationships
             */
            $table->foreign('created_by_user_id')->references('id')->on('users')->onUpdate('cascade');
//            $table->foreign('fiscal_year_id')->references('id')->on('users')->onUpdate('cascade');

            $table->date('url_verification_key_validity_date')->nullable();
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
        Schema::dropIfExists('dms_outgoing_documents');
    }
}
