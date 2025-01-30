<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productsByCategory = [
            'Medicamentos' => ['Aspirina', 'Paracetamol', 'Ibuprofeno'],
            'Suplementos Dietéticos' => ['Proteína en polvo', 'BCAA', 'Omega-3'],
            'Cosméticos' => ['Crema hidratante', 'Pintalabios', 'Base de maquillaje'],
            'Cuidado Personal' => ['Cepillo de dientes', 'Jabón líquido', 'Desodorante'],
            'Higiene y Limpieza' => ['Detergente', 'Limpiador multiusos', 'Toallitas húmedas'],
            'Alimentos y Bebidas' => ['Soda', 'Galletas', 'Cereal'],
            'Vitaminas' => ['Vitamina C', 'Multivitamínico', 'Magnesio'],
            'Cuidado Infantil' => ['Pañales', 'Biberón', 'Leche infantil'],
            'Productos para la Salud' => ['Termómetro', 'Oxímetro', 'Vendas'],
            'Productos Naturales' => ['Aloe vera', 'Aceite de coco', 'Té verde'],
            'Dispositivos Médicos' => ['Mascarilla', 'Termómetro digital', 'Saturómetro'],
            'Herbolaria' => ['Valeriana', 'Manzanilla', 'Ginseng'],
            'Perfumería' => ['Perfume floral', 'Colonia cítrica', 'Agua de colonia'],
            'Productos de Belleza' => ['Crema antiarrugas', 'Exfoliante', 'Mascarilla facial'],
            'Vendas y Curaciones' => ['Vendas elásticas', 'Curitas', 'Alcohol'],
            'Bebidas Energéticas' => ['Red Bull', 'Monster', 'Burn'],
            'Alimentos Especiales' => ['Alimentos sin gluten', 'Alimentos orgánicos', 'Alimentos veganos'],
            'Productos de Aseo' => ['Limpiador de pisos', 'Desinfectante', 'Jabón antibacterial'],
            'Farmacia' => ['Desinfectante', 'Termómetro', 'Antiséptico'],
            'Cuidado Capilar' => ['Shampoo', 'Acondicionador', 'Mascarilla capilar'],
            'Cuidado Bucal' => ['Cepillo eléctrico', 'Hilo dental', 'Enjuague bucal'],
            'Cuidado de la Piel' => ['Crema solar', 'Tónico facial', 'Exfoliante facial'],
            'Lentes y Gafas' => ['Lentes de sol', 'Gafas graduadas', 'Lentes de contacto'],
            'Artículos de Oficina' => ['Lápiz', 'Carpeta', 'Resaltadores'],
            'Vitamínicos' => ['Vitamina D', 'Vitamina E', 'Ácido fólico'],
            'Productos para el Hogar' => ['Lampara LED', 'Alfombra', 'Extintor de fuego'],
            'Aspirinas y Analgésicos' => ['Aspirina', 'Paracetamol', 'Ibuprofeno'],
            'Cremas y Pomadas' => ['Pomada para quemaduras', 'Crema cicatrizante', 'Pomada antiinflamatoria'],
            'Bebidas Saludables' => ['Jugo natural', 'Agua de coco', 'Té verde'],
        ];

        $category = TypeProduct::inRandomOrder()->first();

        $productName = $this->faker->randomElement($productsByCategory[$category->product_type_name]);

        return [
            'type_products_id' => $category->id,
            'code_product' => $this->faker->regexify('[A-Z]{3}-[0-9]{4}'),
            'name_product' => $productName,
            'price_product' => (int) ($this->faker->randomFloat(2, 10, 500) * 100),
            'quantity_products' => $this->faker->numberBetween(1, 500),
        ];
    }
}
