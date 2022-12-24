<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('remaining_leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leave_assignment_id')->constrained()->onDelete('cascade');
            $table->float('remaining_days');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('remaining_leaves');
    }
};
