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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id');
            $table->foreign('animal_id')->references('animal_id')->on('animals');
            $table->date('inspect_date');
            $table->string('illness');
            $table->string('inspect_by');
            $table->text('treatment')->nullable();
            $table->string('treat_by')->nullable();
            $table->date('treat_date')->nullable();
            $table->enum('milking_status', ['Milking','Non-Milking'])->default('Milking');
            $table->enum('treatment_status', ['Completed','Pending'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
