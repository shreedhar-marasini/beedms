<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_document_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_access_user_id')->unsigned();
            $table->enum('tracks_document_type',['incoming','outgoing','digitized']);
            $table->integer('tracks_document_id')->nullable();
            $table->enum('tracks_action_type',['view','edit','delete','download','print','create']);
            $table->date('tracks_action_date')->nullable();
            /*
             * define 'document_access_user_id' in relationship
             */
            $table->foreign('document_access_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('dms_document_tracks');
    }
}
