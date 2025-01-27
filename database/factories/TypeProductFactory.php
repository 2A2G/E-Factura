<?php

namespace Database\Factories;

use App\Models\TypeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeProduct>
 */
class TypeProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_type_name' => $this->faker->randomElement([
                'Medicamentos',
                'Suplementos Dietéticos',
                'Cosméticos',
                'Cuidado Personal',
                'Higiene y Limpieza',
                'Alimentos y Bebidas',
                'Vitaminas',
                'Cuidado Infantil',
                'Productos para la Salud',
                'Productos Naturales',
                'Dispositivos Médicos',
                'Herbolaria',
                'Perfumería',
                'Productos de Belleza',
                'Vendas y Curaciones',
                'Bebidas Energéticas',
                'Alimentos Especiales',
                'Productos de Aseo',
                'Farmacia',
                'Cuidado Capilar',
                'Cuidado Bucal',
                'Cuidado de la Piel',
                'Lentes y Gafas',
                'Artículos de Oficina',
                'Vitamínicos',
                'Productos para el Hogar',
                'Aspirinas y Analgésicos',
                'Cremas y Pomadas',
                'Bebidas Saludables',
            ]),
        ];
    }
}
