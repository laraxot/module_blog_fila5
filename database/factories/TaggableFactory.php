<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaggableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Blog\Models\Taggable::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

