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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->enum('type', ['input', 'select', 'switch', 'radio'])->nullable();
            $table->enum('option_category', ['automotive', 'other'])->nullable();
            $table->enum('operator', ['additive', 'multiplicative', 'no_effect'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
