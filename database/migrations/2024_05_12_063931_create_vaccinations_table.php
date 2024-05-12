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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->string('animal_id');
            $table->foreign('animal_id')->references('animal_id')->on('animals');
            $table->string('vac_name');
            $table->date('vac_date');
            $table->string('vac_by');
            $table->string('next_vac_name')->nullable();
            $table->date('next_vac_date')->nullable();
            $table->enum('status', ['Completed','Incomplete'])->default('Completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
