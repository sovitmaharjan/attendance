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
            $table->dateTime('from_date');
            $table->dateTime('to_date');
            $table->float('leave_days_count');
            $table->float('remaining_allowed_days');
            $table->text('description')->nullable();
            $table->tinyInteger('is_approved')->default(0);
            $table->foreignId('approver')->nullable()->constrained('users');
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_applications');
    }
};
