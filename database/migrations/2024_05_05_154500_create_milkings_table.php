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
        Schema::create('milkings', function (Blueprint $table) {
            $table->id();
            $table->date('milking_date');
            $table->string('animal_id');
            $table->foreign('animal_id')->references('animal_id')->on('animals');
            $table->decimal('morning_vol')->default(0.00);
            $table->string('mor_added_by')->nullable();
            $table->string('mor_updated_by')->nullable();
            $table->date('mor_updated_date')->nullable();
            $table->decimal('evening_vol')->default(0.00);
            $table->string('eve_added_by')->nullable();
            $table->string('eve_updated_by')->nullable();
            $table->date('eve_updated_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milkings');
    }
};
