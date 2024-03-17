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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id')->unique();
            $table->date('birth_date');
            $table->string('breed');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('stall_number')->nullable();
            $table->decimal('weight_at_birth')->default(0.00);
            $table->decimal('height_at_birth')->default(0.00);
            $table->date('buy_date')->nullable();
            $table->decimal('buy_price')->default(0.00);
            $table->text('notes')->nullable();
            $table->string('father_id')->nullable();
            $table->string('mother_id')->nullable();
            $table->enum('pregnant_status', ['Yes','No'])->default('No');
            $table->integer('pregnancy_occ')->default(0);
            $table->date('next_pregnancy_appox_date')->nullable();
            $table->enum('milking_status', ['Milking','Dry-Period', 'Non-Milking'])->default('Non-Milking');
            $table->string('created_by');
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
