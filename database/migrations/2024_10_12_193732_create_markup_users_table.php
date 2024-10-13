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
        Schema::create('markup_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->unique();
            $table->decimal('value', 5, 2);
            $table->timestamps();
        });

        // Insert example sellers with their respective discounts
        DB::table('markup_users')->insert([
            [
                'type' => 'seller',
                'value' => -2.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'customer',
                'value' => 0.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'dropshipper',
                'value' => -10.00,
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
        Schema::dropIfExists('markup_users');
    }
};
