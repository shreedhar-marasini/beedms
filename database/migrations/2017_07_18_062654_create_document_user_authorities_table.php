<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentUserAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_document_user_authorities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('authorized_document_id')->nullable();
            $table->integer('authorized_user_id')->unsigned();
            $table->enum('authorized_document_type',['incoming','outgoing','digitized']);
            $table->date('document_authority_date');
            /*
             * define 'authorized_user_id'
             */
            $table->foreign('authorized_user_id')->references('id')->on('users')->onUpdate('cascade');

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
        Schema::dropIfExists('dms_document_user_authorities');
    }
}
