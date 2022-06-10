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
        Schema::create('loan_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('loan_score');
            $table->unsignedBigInteger('amount');
            $table->unsignedSmallInteger('percentage');
            $table->unsignedMediumInteger('duration');
            $table->foreignId('status_id')->constrained();
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
        Schema::dropIfExists('loan_packages');
    }
};
