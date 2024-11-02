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
        Schema::create('creatives', function (Blueprint $table) {
            $table->id();
            $table->string('creative_name');
            $table->unsignedBigInteger('height');
            $table->unsignedBigInteger('width');
            $table->json('main_asset')->nullable();
            $table->string('logo_asset')->nullable();
            $table->string('cta')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('cta_position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creatives');
    }
};
