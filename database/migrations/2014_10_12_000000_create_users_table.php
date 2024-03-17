<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('gender', ['Male', 'Female']);
            $table->date('joined_date');
            $table->string('nic');
            $table->string('mobile_number');
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('prof_pic')->nullable();
            $table->enum('role', ['Admin','Manager','Office Staff','Medical Staff', 'Field Staff', 'Stores Staff', 'User'])->default('User');
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
