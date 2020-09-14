<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNameCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_name_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institution_id')->unsigned();
            $table->string('name_card_person')->nullable();
            $table->string('name_card_address')->nullable();
            $table->string('name_card_designation')->nullable();
            $table->string('name_card_email_address1')->nullable();
            $table->string('name_card_email_address2')->nullable();
            $table->string('name_card_contact_number1')->nullable();
            $table->string('name_card_contact_number2')->nullable();
            $table->string('business_card')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('institution_id')->references('id')->on('dms_institutions')->onUpdate('cascade');

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
        Schema::dropIfExists('dms_name_cards');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
