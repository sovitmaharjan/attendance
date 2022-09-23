<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('in_time');
            $table->dateTime('in_time_last')->nullable();
            $table->dateTime('out_time');
            $table->dateTime('out_time_last')->nullable();
            $table->integer('break_time');
            $table->json('extra')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
};
