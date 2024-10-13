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
        Schema::create('markup_quantities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('min_quantity')->index();
            $table->integer('max_quantity')->index();
            $table->decimal('value', 5, 2);
            $table->timestamps();
        });

        DB::table('markup_quantities')->insert([
            [
                'value' => -5.00,
                'min_quantity' => 10,
                'max_quantity' => 19,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'value' => -10.00,
                'min_quantity' => 20,
                'max_quantity' => 29,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markup_quantities');
    }
};
