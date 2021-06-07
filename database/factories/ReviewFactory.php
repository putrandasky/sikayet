<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => mt_rand(1, 5),
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->sentence(20),
            'review_type_id' => mt_rand(1, 3),
            'review_status_id' => mt_rand(1, 3),
            'accept_tnc' => 'accepted',

        ];

    }
}
