<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institution_name')->nullable();
            $table->string('institution_address')->nullable();
            $table->string('institution_email_address')->nullable();
            $table->string('institution_contact_number')->nullable();
            $table->string('institution_website')->nullable();
            $table->integer('institution_pan_number')->nullable();
            $table->string('institution_image')->nullable();
            $table->date('deleted_at')->nullable();
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('dms_institutions');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
