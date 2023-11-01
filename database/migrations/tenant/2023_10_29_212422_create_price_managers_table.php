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
        Schema::create('model_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('model_id');
            $table->tinyInteger('is_range')->default(1);
            $table->year('year_start');
            $table->year('year_end')->nullable();
            $table->integer('service_id');
            $table->integer('key_type_id')->nullable();
            $table->string('PN')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('pts')->nullable();
            $table->tinyInteger('oem')->nullable();
            $table->tinyInteger('akl')->nullable();
            $table->decimal('amount', 10, 2);
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_prices');
    }
};
