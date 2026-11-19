<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Models\TextWidget;

/**
 * @extends Factory<TextWidget>
 */
class TextWidgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TextWidget>
     */
    protected $model = TextWidget::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
<<<<<<< HEAD
    public function definition(): array
=======
    public function definition()
>>>>>>> laraxot/dev
    {
        return [
            'key' => fake()->word,
            'image' => fake()->image,
            'title' => fake()->sentence,
            'content' => fake()->text,
            'active' => fake()->boolean,
        ];
    }
}
