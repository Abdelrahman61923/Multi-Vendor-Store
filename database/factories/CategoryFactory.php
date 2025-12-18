<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'slug' => Str::slug($this->faker->words(2, true)),
            'description' => $this->faker->sentence(15),
            'status' => $this->faker->randomElement(['active', 'archived']),
            'image' => $this->faker->imageUrl(),
        ];

        // // if you use the package
        // return [
        //     'name' => $this->faker->department,
        //     'slug' => Str::slug($this->faker->department),
        //     'description' => $this->faker->sentence(15),
        //     'image' => $this->faker->imageUrl(),
        // ];
    }
}
