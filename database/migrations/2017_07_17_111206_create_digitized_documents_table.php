<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDigitizedDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_digitized_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_category_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->integer('template_id')->unsigned()->nullable();
            $table->integer('uploaded_by_user_id')->unsigned();
            $table->integer('related_institution_id')->unsigned();
            $table->string('digitized_document_name')->nullable();
            $table->string('digitized_document_description')->nullable();
            $table->string('digitized_document_path')->nullable();
            $table->date('digitized_document_date');
            $table->text('digitized_document_content')->nullable();
            $table->enum('digitized_document_privacy',['Confidential','Departmental','General']);
            $table->date('digitized_document_reminder_date')->nullable();
            $table->string('digitized_document_reminder_content')->nullable();
            $table->date('deleted_at')->nullable();
            $table->foreign('document_category_id')->references('id')->on('dms_document_categories')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('cascade');
            $table->integer('folder_id');
            /*
             * define "uploaded_by_user_id" in relationship
             */
            $table->foreign('uploaded_by_user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('related_institution_id')->references('id')->on('dms_institutions')->onUpdate('cascade');





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
        Schema::dropIfExists('dms_digitized_documents');
    }
}
