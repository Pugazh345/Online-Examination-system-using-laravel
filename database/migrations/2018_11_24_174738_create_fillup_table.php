<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFillupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fillup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examidfk')->unsigned();
            $table->foreign('examidfk')->references('id')->on('exams');
            $table->string('question');
            $table->string('crctanswer');
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
        Schema::dropIfExists('fillup');
    }
}
