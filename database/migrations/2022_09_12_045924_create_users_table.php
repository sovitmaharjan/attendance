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
            $table->string('prefix'); // enum
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('gender'); // enum
            $table->string('relationship'); // enum
            $table->dateTime('dob');
            $table->dateTime('join_date')->default(now());
            $table->string('email')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->string('login_id')->unique();
            $table->foreignId('supervisor')->nullable()->constrained('users');
            $table->string('password');
            $table->string('login_count')->nullable();
            $table->string('status'); // enum
            $table->string('type'); // enum
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
