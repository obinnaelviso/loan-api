<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('reference_number')->unique();
            $table->unsignedInteger('loan_score');
            $table->unsignedSmallInteger('percentage');
            $table->unsignedMediumInteger('duration');
            $table->unsignedInteger('amount');
            $table->unsignedInteger('due_amount');
            $table->unsignedInteger('interest');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->foreignId('bank_account_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
