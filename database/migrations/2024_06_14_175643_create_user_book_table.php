<?php

use App\Enums\BookLoanStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_user', function (Blueprint $table) {
            $table->uuid('id');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('book_id')->constrained()->onDelete('cascade');
            $table->enum('status', [BookLoanStatusEnum::class]);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_user');
    }
};
