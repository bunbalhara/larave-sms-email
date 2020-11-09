<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipient_id');
            $table->string('group_id');
            $table->string('message_sid');
            $table->string('service_sid');
            $table->string('service_name');
            $table->string('sender_number');
            $table->string('sender_name');
            $table->string('content');
            $table->integer('error_code')->nullable();
            $table->string('status')->default('pending');
            $table->dateTime('delivered');
            $table->foreign('recipient_id')
                ->references('id')
                ->on('recipients')
                ->onDelete('cascade');
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
        Schema::dropIfExists('messages');
    }
}
