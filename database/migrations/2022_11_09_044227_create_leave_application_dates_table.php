<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leave_application_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_application_id')->constrained()->ondelete('cascade');
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_application_dates');
    }
};
