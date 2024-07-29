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
        Schema::create('countries', function (Blueprint $table) {
            $table->string('id', false)->primary();
            $table->string('name');
            $table->string('alpha_3')->unique();
            $table->string('numeric_3')->unique();
            $table->timestamps();
        });
        // Schema::create('states', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('country_id');
        //     $table->timestamps();
        // });
        // Schema::create('provinces', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('state_id');
        //     $table->timestamps();
        // });
        // Schema::create('cities', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('province_id');
        //     $table->timestamps();
        // });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
        // Schema::dropIfExists('states');
        // Schema::dropIfExists('provinces');
        // Schema::dropIfExists('cities');
    }
};
