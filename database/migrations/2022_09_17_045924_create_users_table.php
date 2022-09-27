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
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->string('marital_status');
            $table->dateTime('dob')->nullable();
            $table->dateTime('join_date')->default(now());

            $table->foreignId('company_id')->constrained();
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
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
