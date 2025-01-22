<?php

namespace Database\Seeders;

use App\Models\TypeProduct;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Aldair Gutierrez',
            'email' => 'aldair@e-factura.com',
            'password' => bcrypt('password'),
        ]);

        $this->call(TypeProductSeeder::class);
    }
}
