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
        Schema::create('user_representatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_information_id')->index();
            $table->string('representative_first_name');
            $table->string('representative_middle_name')->nullable();
            $table->string('representative_last_name');
            $table->text('representative_valid_id_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_representatives');
    }
};
