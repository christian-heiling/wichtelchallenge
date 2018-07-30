<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('from_user_id')->nullable();
            $table->unsignedInteger('present_id');
            $table->text('content');
            $table->timestamps();

            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('present_id')->references('id')->on('presents')->onDelete('cascade');
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
