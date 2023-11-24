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
            $table->tinyText('name')->nullable();
            $table->decimal('last_quoted', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('call_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('status', ['Active', 'Booked', 'Failed', 'Invalid', 'Warning']);
            $table->tinyInteger('incoming')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('custom_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->unsignedBigInteger('caller_type')->nullable();
            $table->unsignedBigInteger('locations')->nullable();
            $table->unsignedBigInteger('caa')->nullable();
            $table->unsignedBigInteger('day_night')->nullable();
            $table->unsignedBigInteger('lost_spare_keys')->nullable();
            $table->timestamps();
        });

        Schema::create('lead_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id');
            $table->foreign('lead_id')->references('id')->on('leads');
            $table->unsignedBigInteger('price_id')->nullable();
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
