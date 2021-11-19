<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Guessnumber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guessnumber_history', function (Blueprint $table) {
            $table->increments('game_id');
            $table->integer('move_number');
            $table->integer('guess_value');
            $table->integer('generated_value');
            $table->enum('computer_answer', ['more', 'less', 'bingo']);
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
        Schema::dropIfExists('guessnumber_history');
    }
}
