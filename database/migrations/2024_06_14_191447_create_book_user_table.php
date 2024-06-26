<?php

use App\Enums\LoanStatusEnum;
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
            $table->bigIncrements('id');
            $table->foreignUuid('user_id')->references('id')->on('users');
            $table->foreignUuid('book_id')->references('id')->on('books');
            $table->enum(
                'loan_status',
                [
                    LoanStatusEnum::LATE->value,
                    LoanStatusEnum::RETURNED->value,
                    LoanStatusEnum::OK->value,
                ]
            )->default(LoanStatusEnum::OK->value);

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
