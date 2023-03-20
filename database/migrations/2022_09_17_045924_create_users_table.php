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
            $table->string('login_id')->unique();
            $table->string('password');
            
            $table->string('prefix')->nullable();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');

            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            
            $table->date('dob')->nullable();
            $table->date('join_date')->default(now());
            
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            $table->string('citizenship_number')->nullable();
            $table->string('pan_number')->nullable();
            
            $table->string('email')->nullable();

            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            
            $table->foreignId('designation_id')->constrained();
            $table->foreignId('role_id')->constrained();

            $table->foreignId('supervisor_id')->nullable()->constrained('users');

            $table->integer('login_count')->nullable();

            $table->string('status');
            $table->string('type');

            $table->string('official_email')->nullable()->unique();
            $table->json('extra')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
