<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_user_id')->unsigned();
            $table->string('notification_title')->nullable();
            $table->string('notification_action_url')->nullable();
            $table->date('notification_date');
            $table->date('notification_read_date')->nullable();
            $table->integer('notifier_user_id')->nullable();
            /*
             * defines "notification_user_id" in relationships
             */
            $table->foreign('notification_user_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('dms_notifications');
    }
}
