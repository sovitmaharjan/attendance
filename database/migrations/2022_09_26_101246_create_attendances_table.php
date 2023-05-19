<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_schedule_assignment_id')->nullable()->constrained();
            $table->foreignId('employee_id')->constrained('users');
            $table->date('date');
            $table->enum('day', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
            $table->integer('shift')->default(1);
            $table->time('in_time')->nullable();
            $table->string('in_mode')->nullable(); // thumb, facial, force
            $table->string('in_remarks')->nullable();
            $table->time('out_time')->nullable();
            $table->string('out_mode')->nullable(); // thumb, facial, force
            $table->string('out_remarks')->nullable();
            $table->time('time_difference');
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
