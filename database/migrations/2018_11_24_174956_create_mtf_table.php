<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMtfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtf', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examidfk')->unsigned();
            $table->foreign('examidfk')->references('id')->on('exams');
            $table->string('question');
            $table->string("columna");
            $table->string("ca1");
            $table->string("ca2");
            $table->string("ca3");
            $table->string("ca4");
            $table->string("columnb");
            $table->string("cb1");
            $table->string("cb2");
            $table->string("cb3");
            $table->string("cb4");
            $table->string("cb5");
            $table->string("optiona");
            $table->string("optionb");
            $table->string("optionc");
            $table->string("optiond");
            $table->string("crctanswer");


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
        Schema::dropIfExists('mtf');
    }
}
