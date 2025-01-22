<?php

namespace Database\Seeders;

use App\Models\TypeProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeProduct::factory(10)->create();

    }
}
