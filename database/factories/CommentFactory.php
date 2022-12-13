<?php

namespace Database\Factories;
use App\Models\Gallery;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'comment' => $this->faker->paragraph(2),
        'user_id' => User::factory(1)->create()->first(),
        'gallery_id' => Gallery::factory(1)->create()->first(),
        ];
    }
}
