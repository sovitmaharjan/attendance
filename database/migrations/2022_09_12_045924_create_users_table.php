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
            $table->enum('prefix', ['Mr.', 'Mrs.', 'Miss', 'Mx.', 'Ms.', 'Dr.', 'Er.']);
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->enum('relationship', ['Single', 'Married', 'Separated', 'Divorced']);
            $table->dateTime('dob');
            $table->dateTime('nepali_dob')->nullable();
            $table->dateTime('join_date')->default(now());
            $table->dateTime('nepali_join_date')->nullable();
            $table->string('email')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->string('login_id')->unique();
            $table->foreignId('supervisor')->nullable()->constrained('users');
            $table->string('password');
            $table->string('login_count')->nullable();
            $table->enum('status', ['Working', 'Suspended', 'Discharged', 'Dismissed', 'Resigned', 'Inactive']);
            $table->enum('type', ['Temporary', 'Permanent', 'Contract', 'Casual', 'Trainee', 'Probation']);
            $table->string('official_email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
