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
        Schema::create('main', function (Blueprint $table) {
            $table->id();
            //  Hero
            $table->string('hero_cover');
            $table->string('hero_title');
            $table->string('hero_subtitle');
            $table->string('hero_cta_title');
            $table->string('hero_cta_link');

            // Card 1:-
            $table->string('hero_card_1'); // [{title,subtitle},...]

            // Slider
            $table->string('hero_slider_title');
            $table->string('hero_slider_imgs');

            // Card 2:-
            $table->string('hero_card_2'); // [{icon,title,subtitle},...]


            // Section 1:-
            $table->string('section_1_title');
            $table->string('section_1_subtitle');
            // card 1
            $table->string('section_1_card_1_title');
            $table->string('section_1_card_1_subtitle');
            $table->string('section_1_card_1_cta');
            // card 2
            $table->string('section_1_card_2_title');
            $table->string('section_1_card_2_subtitle');
            $table->string('section_1_card_2_cta');
            // card 3
            $table->string('section_1_card_3_title');
            $table->string('section_1_card_3_subtitle');
            $table->string('section_1_card_3_cta');

            // Section 2:-
            $table->string('section_2_title');
            $table->string('section_2_subtitle');
            $table->string('section_2_icons'); // ['/storage/icons/1.png', '/storage/icons/2.png', '/storage/icons/3.png', '/storage/icons/4.png']

            // Section 3:-
            $table->string('section_3_title');
            // card 1
            $table->string('section_3_card_1_icon');
            $table->string('section_3_card_1_title');
            $table->string('section_3_card_1_features'); // ['lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet']
            $table->string('section_3_card_1_cta');
            // card 2
            $table->string('section_3_card_2_icon');
            $table->string('section_3_card_2_title');
            $table->string('section_3_card_2_features'); // ['lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet']
            $table->string('section_3_card_2_cta');
            // card 3
            $table->string('section_3_card_3_icon');
            $table->string('section_3_card_3_title');
            $table->string('section_3_card_3_features'); // ['lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet']
            $table->string('section_3_card_3_cta');

            // Section 4:-
            $table->string('section_4_cover');
            $table->string('section_4_title');
            $table->string('section_4_cta_title');
            $table->string('section_4_cta_link');

            // Section 5:-
            $table->string('section_5_title');
            $table->string('section_5_card_img');
            $table->string('section_5_card_card'); // (array-objects) // [{title,subtitle},...]

            // Section 6:-
            $table->string('section_6_title');
            $table->string('section_6_slider'); // (array-objects) // [{type:'img'|'text',icon,text_1_title,text_1_subtitle,text_2_title,text_2_subtitle,cta_title,cta_link}]

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main');
    }
};
