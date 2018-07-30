<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wish_id');
            $table->unsignedInteger('from_user_id');
            $table->enum('state', \App\Present::getAvailableStates());
            $table->date('due_date');
            $table->unsignedInteger('amount');
            $table->timestamps();

            $table->foreign('wish_id')->references('id')->on('wishes')->onDelete('cascade');
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presents');
    }
}
