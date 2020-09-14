<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_document_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commented_by_user_id')->unsigned();
            $table->integer('documents_id')->nullable();
            $table->text('document_comments_description')->nullable();
            $table->enum('document_comments_type',['incoming','outgoing','digitized']);
            $table->string('document_comments_upload')->nullable();
            /*
             * define 'commented_by_user_id' in relationships
             */
            $table->foreign('commented_by_user_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('dms_document_comments');
    }
}
