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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->enum('category', ['Automotive', 'Buildings'])->nullable()->default('Automotive');
            $table->tinyInteger('flat_charge');
            $table->enum('type', ['regular', 'flat_rate', 'option_based'])->nullable();
            $table->enum('operator', ['additive', 'multiplicative'])->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->enum('choices', ['key_type_id', 'pts', 'oem', 'akl'])->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
