<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_off_days_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Department::class)->nullable()->onDelete('cascade');
            $table->json('days')->nullable();
            $table->date('date')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_off_days_tracks');
    }
};
