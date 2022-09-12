<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('model_has_status', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->string('model_id');
            $table->foreignId('status_id')->constrained('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_status');
    }
};
