<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Auction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Auction::create([
            'user_id' => $user->id,
            'name' => 'Test Auction 1',
            'description' => 'This is a test auction for testing',
            'price' => 20.50,
            'time' => Carbon::now()->toDateTimeString(),
        ]);
        Auction::create([
            'user_id' => $user->id,
            'name' => 'Test Auction 2',
            'description' => 'This is also a test auction for testing',
            'price' => 1500.00,
            'time' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
