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
        Schema::create('driving_licence', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('driving_licence_series');
            $table->string('driving_licence_number');
            $table->date('driving_getting');
            $table->date('driving_deprivation');
            $table->foreignId('driving_licence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
