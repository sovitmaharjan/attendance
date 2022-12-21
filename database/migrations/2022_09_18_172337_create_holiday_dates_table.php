<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('holiday_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('holiday_id')->constrained()->onDelete('cascade');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('holiday_dates');
    }
};
