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
        Schema::create('markup_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->decimal('value', 5, 2);
            $table->timestamps();
        });

        DB::table('markup_categories')->insert([
            [
                'name' => 'electronics',
                'value' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'furniture',
                'value' => -10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'clothing',
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
        Schema::dropIfExists('markup_categories');
    }
};
