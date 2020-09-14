<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_document_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_id')->nullable();
            $table->integer('tag_id')->unsigned();
            $table->enum('document_tag_type',['incoming','outgoing','digitized']);
            $table->foreign('tag_id')->references('id')->on('dms_tags')->onUpdate('cascade');

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
        Schema::dropIfExists('dms_document_tags');
    }
}
