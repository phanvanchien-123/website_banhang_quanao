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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('town_city');
            $table->dropColumn('street_address');

            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('town_city')->nullable();
            $table->string('street_address')->nullable();

            $table->dropColumn('province_id')->nullable();
            $table->dropColumn('district_id')->nullable();
            $table->dropColumn('ward_id')->nullable();
        });

    }
};
