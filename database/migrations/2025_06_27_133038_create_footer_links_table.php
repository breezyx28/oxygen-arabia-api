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
        Schema::create('footer_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('footer_section_id'); // Section this link belongs to
            $table->string('title');                // Link label
            $table->string('url')->nullable();      // Link URL
            $table->string('icon')->nullable();     // Optional icon (path or class)
            $table->integer('order')->default(0);   // For ordering within section
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('footer_section_id')->references('id')->on('footer_sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_links');
    }
};
