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
        $admin = User::factory([
            'is_admin' => true,
            'mobile_number' => '09301111357',
        ])
            ->has(
                Invoice::factory()
                    ->count(5)
                    ->has(
                        Product::factory()->count(8)
                    )
            )
            ->create();

        $user = User::factory()->create([
            'is_admin' => false,
            'mobile_number' => '09302211357',
        ]);

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
