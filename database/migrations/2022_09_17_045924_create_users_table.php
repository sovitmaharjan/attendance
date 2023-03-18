<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->date('dob')->nullable();
            $table->date('join_date')->default(now());

            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('designation_id')->constrained();
            $table->string('login_id')->unique();
            $table->foreignId('supervisor_id')->nullable()->constrained('users');
            $table->string('password');
            $table->integer('login_count')->default(0);
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('official_email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('role_id')->constrained();
            $table->rememberToken();
            $table->json('extra')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
