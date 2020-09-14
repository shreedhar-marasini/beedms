<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('document_category_id')->unsigned();
            $table->string('template_name')->nullable();
            $table->string('template_short_name')->nullable();
            $table->text('template_content');
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('document_category_id')->references('id')->on('dms_document_categories')->onUpdate('cascade');
            $table->text('template_subject');
            $table->enum('include_header',['yes','no'])->default('yes');
            $table->enum('include_footer',['yes','no'])->default('yes');
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
        Schema::dropIfExists('dms_templates');
    }
}
