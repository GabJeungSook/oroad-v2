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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('campus_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('user_type_id')->constrained();
            $table->foreignId('region_code');
            $table->foreignId('province_code');
            $table->foreignId('city_code');
            $table->string('postal_code');
            $table->text('other_address_details');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('contact_number')->nullable();
            $table->string('gender');
            $table->date('birthday');
            $table->text('valid_id_path');
            $table->boolean('has_representative')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
