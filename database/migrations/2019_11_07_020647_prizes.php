<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->index()->comment('Prize type');
            $table->string('value')->index()->comment('Prize value');
            $table->unsignedBigInteger('user_id')->index()->comment('Prize user');
            $table->timestamps();
            $table->dateTime('sended_at')->nullable()->comment('When prize goes to user');
            $table->dateTime('collected_at')->nullable()->comment('When prize collected by user');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prizes');
    }
}
