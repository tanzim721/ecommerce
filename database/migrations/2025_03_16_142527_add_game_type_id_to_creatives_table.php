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
        Schema::table('creatives', function (Blueprint $table) {
            if (!Schema::hasColumn('creatives', 'game_type_id')) {
                $table->unsignedBigInteger('game_type_id')->after('creative_type_id');
            }
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('creatives', function (Blueprint $table) {
            $table->dropForeign(['game_type_id']);
            $table->dropColumn('game_type_id');
        });
    }
};
