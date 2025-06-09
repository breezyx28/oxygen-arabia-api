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
        Schema::create('form', function (Blueprint $table) {
            $table->id();

            $table->string('page_name');

            $table->string('form_header_title');

            $table->string('form_direction'); // ['ltr', 'rtl']

            $table->string('form_person_img');
            $table->string('form_person_qoute');
            $table->string('form_person_name');
            $table->string('form_person_position');

            $table->string('input_first_name_label');
            $table->string('input_first_name_placeholder');

            $table->string('input_first_last_label');
            $table->string('input_first_last_placeholder');

            $table->string('input_email_label');
            $table->string('input_email_placeholder');

            $table->string('input_phone_label');
            $table->string('input_phone_placeholder');

            $table->string('input_company_name_label');
            $table->string('input_company_name_placeholder');

            $table->string('input_company_size_label');
            $table->string('input_company_size_placeholder');

            $table->string('option_most_interested_label');
            $table->string('option_most_interested_options'); // ['lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet', 'lorem ipsum dolor sit amet']
            $table->string('form_btn_title');
            $table->string('form_footer');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form');
    }
};
