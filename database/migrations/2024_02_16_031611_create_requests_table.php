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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number');
            $table->foreignId('purpose_id')->index();
            $table->foreignId('user_information_id')->index();
            $table->foreignId('approved_by')->nullable()->index();
            $table->text('other_purpose')->nullable();
            $table->text('total_amount');
            $table->string('status');
            $table->text('remarks')->nullable();
            $table->boolean('has_representative')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('denied_at')->nullable();
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
