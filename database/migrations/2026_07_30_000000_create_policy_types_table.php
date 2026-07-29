<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('policy_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        $now = now();
        DB::table('policy_types')->insert([
            ['name' => 'Cancellation Policy', 'slug' => 'cancellation', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Flight Change Policy', 'slug' => 'flight-change', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Name Change Policy', 'slug' => 'name-change', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Reservation Policy', 'slug' => 'reservation-policy', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Baggage Policy', 'slug' => 'baggage-policy', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Refund Policy', 'slug' => 'refund-policy', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('policy_types');
    }
};
