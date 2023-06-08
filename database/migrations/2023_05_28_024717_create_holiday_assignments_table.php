<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('holiday_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('holiday_id')->constrained();
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');
            $table->date('assigned_date');
            $table->enum('assigned_day', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])->nullable();
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('holiday_assignments');
    }
};
