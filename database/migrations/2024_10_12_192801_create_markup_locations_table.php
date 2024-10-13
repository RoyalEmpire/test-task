<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('markup_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city')->unique();
            $table->decimal('value', 5, 2);
            $table->timestamps();
        });

        DB::table('markup_locations')->insert([
            [
                'city' => 'kyev',
                'value' => 2.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city' => 'lviv',
                'value' => -3.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'city' => 'odessa',
                'value' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markup_locations');
    }
};
