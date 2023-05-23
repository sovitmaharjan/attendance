<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('device_records', function (Blueprint $table) {
            $table->id();$table->integer('shift')->default(1);

            $table->enum('in_day', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])->nullable();
            $table->date('in_date')->nullable();
            $table->time('in_time')->nullable();
            $table->string('in_mode')->nullable(); // thumb, facial, force
            $table->string('in_remarks')->nullable();

            $table->enum('out_day', ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])->nullable();
            $table->date('out_date')->nullable();
            $table->time('out_time')->nullable();
            $table->string('out_mode')->nullable(); // thumb, facial, force
            $table->string('out_remarks')->nullable();

            $table->json('extra');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('device_records');
    }
};
