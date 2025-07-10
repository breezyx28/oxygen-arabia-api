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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();   // e.g. 'general', 'social', 'mail'
            $table->string('key');                 // e.g. 'site_name'
            $table->text('value')->nullable();
            $table->timestamps();

            $table->unique(['group', 'key']);


            // id | group  | key	        value
            // -----------------------------------------
            // 1  |	general	site_name	     My Website
            // 2  |	general	logo	        /storage/logo.png
            // 3  |	general	contact_email	info@example.com
            // 4  |	social	facebook	    https://facebook.com/myweb
            // 5  |	social	twitter	        https://twitter.com/myweb
            // 6  |	mail	smtp_host	    smtp.mailtrap.io

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
