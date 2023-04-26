<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_id')->constrained();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('year')->default(date('Y'));
            $table->float('leave_duration');
            $table->text('description')->nullable();
            $table->string('status')->default('pending');
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_applications');
    }
};
