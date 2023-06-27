<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory(['is_admin' => true, 'email' => 'admin@gmail.com'])
            ->has(
                Invoice::factory()
                    ->count(5)
                    ->has(
                        Product::factory()->count(8)
                    )
            )
            ->create();

        $user = User::factory()->create(['is_admin' => false, 'email' => 'user@gmail.com']);

        User::factory()
            ->count(20)
            ->has(
                Invoice::factory()
                    ->count(5)
                    ->has(
                        Product::factory()->count(8)
                    )
            )
            ->create();
    }
}
