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
        Schema::create('footer', function (Blueprint $table) {
            $table->id();

            $table->string('footer_logo');
            $table->string('footer_title');

            $table->string('footer_links'); // (array-objects) // [{header:string,links:[{title,link}]}]

            $table->string('footer_social_links'); // (array-objects) // [{name,link,icon}]

            $table->string('footer_copyright_title');
            $table->string('footer_copyright')->default('Copyright © ' . date('Y') . ' Oxygen Arabia LLC. All rights reserved');
            $table->string('footer_copyright_link')->default('https://oxygenarabia.com');

            $table->string('footer_legal_links'); // (array-objects) // [{title,link}]

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer');
    }
};
