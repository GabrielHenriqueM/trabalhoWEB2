<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->word() . ' ' . $this->faker->word(),
            'preco' => $this->faker->randomFloat(2, 1000, 10000),
            'quantidade' => $this->faker->numberBetween(1, 100),
            'marca' => $this->faker->company(),
            'modelo' => $this->faker->word() . ' ' . $this->faker->numberBetween(1000, 9999),
            'processador' => $this->faker->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
            'ram' => $this->faker->randomElement(['4GB', '8GB', '16GB', '32GB']),
            'armazenamento' => $this->faker->randomElement(['128GB SSD', '256GB SSD', '512GB SSD', '1TB SSD']),
            'tela' => $this->faker->randomElement(['13.3 polegadas', '15.6 polegadas', '17 polegadas']),
            'sistema' => $this->faker->randomElement(['Windows 10', 'Windows 11', 'Linux', 'MacOS']),
        ];
    }
}
