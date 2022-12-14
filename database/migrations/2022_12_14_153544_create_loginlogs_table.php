<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginlogs', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('device')->nullable();
            $table->string('ip')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();
            $table->string('broversion')->nullable();
            $table->string('plaversion')->nullable();
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
        Schema::dropIfExists('loginlogs');
    }
};
