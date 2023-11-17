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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->tinyText('phone');
            $table->tinyText('name');
            $table->decimal('last_quoted', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('call_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['Active', 'Booked', 'Failed', 'Invalid', 'Warning']);
            $table->tinyInteger('incoming');
            $table->datetime('timestamp');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('custom_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service');
            $table->unsignedBigInteger('make');
            $table->unsignedBigInteger('model');
            $table->unsignedBigInteger('year');
            $table->tinyInteger('remote');
            $table->unsignedBigInteger('key_type_id');
            $table->tinyInteger('oem');
            $table->tinyInteger('pts');
            $table->tinyInteger('akl');
            $table->timestamps();
        });

        Schema::create('lead_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');

            $table->unsignedBigInteger('price_id')->nullable();
            $table->foreign('price_id')->references('id')->on('custom_prices');

            $table->enum('type', ['regular', 'flat_rate', 'option_based', 'custom_price']);
            $table->integer('qty');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('call_logs');
        Schema::dropIfExists('leads');
        Schema::dropIfExists('lead_items');
        Schema::dropIfExists('custom_prices');
    }
};
