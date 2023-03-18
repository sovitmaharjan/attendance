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
            $table->time('in_time');
            $table->time('in_time_last')->nullable();
            $table->time('out_time');
            $table->time('out_time_last')->nullable();
            $table->integer('break_time')->nullable();
            $table->boolean('status')->default(1);
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
};
