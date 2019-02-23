<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductexamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductexam', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examidfk')->unsigned();
            $table->foreign('examidfk')->references('id')->on('exams');
            $table->integer('batchfk')->unsigned();
            $table->foreign('batchfk')->references('batch')->on('batch');
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
        Schema::dropIfExists('conductexam');
    }
}
