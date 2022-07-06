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
        Schema::table('user_infos', function (Blueprint $table) {
            $table->string("nok_name")->nullable()->after('postal_code');
            $table->string("nok_phone")->nullable('nok_name')->after('nok_name');
            $table->string("nok_email")->nullable('nok_email')->after('nok_phone');
            $table->string("nok_address")->nullable('nok_address')->after('nok_email');
            $table->string("nok_relationship")->nullable('nok_relationship')->after('nok_address');
            $table->foreignId("checked_by")->nullable()->after('nok_relationship')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropColumn([
                'nok_name',
                'nok_phone',
                'nok_email',
                'nok_address',
                'nok_relationship',
                'checked_by'
            ]);
        });
    }
};
