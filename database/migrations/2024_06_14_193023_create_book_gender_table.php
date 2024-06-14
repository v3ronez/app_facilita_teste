<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_gender', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignUuid('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreignId('gender_id')->references('id')->on('genders')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_gender');
    }
};
