<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shift_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shift_id')->constrained();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->dateTime('date')->unique();
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shift_assignments');
    }
};
