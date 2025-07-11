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
        Schema::table('main', function (Blueprint $table) {
            $table->boolean('hero_card_1_active')->default(1);
            $table->boolean('hero_card_2_active')->default(1);
            $table->boolean('hero_slider_active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main', function (Blueprint $table) {
            $table->dropColumn('hero_card_1_active');
            $table->dropColumn('hero_card_2_active');
            $table->dropColumn('hero_slider_active');
        });
    }
};
