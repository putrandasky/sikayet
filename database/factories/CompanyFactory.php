<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company_name = $this->faker->company();
        $star_5 = mt_rand(30, 50);
        $star_4 = mt_rand(10, 20);
        $star_3 = mt_rand(1, 2);
        $star_2 = mt_rand(1, 2);
        $star_1 = mt_rand(1, 2);
        $review = $star_5 + $star_4 + $star_3 + $star_2 + $star_1;
        $rating = (($star_5 * 5) + ($star_4 * 4) + ($star_3 * 3) + ($star_2 * 2) + ($star_1 * 1)) / $review;
        $general = $review - mt_rand(0, $review);
        $complaint = $general - mt_rand(0, $general);
        $solution = $complaint - mt_rand(0, $complaint);
        return [
            'name' => $company_name,
            'slug' => Str::slug($company_name, '_'),
            'email' => $this->faker->safeEmail(),
            'profile' => $this->faker->sentence($nbWords = 20, $variableNbWords = true),
            'rating' => $rating,
            'review' => $review,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'website' => $this->faker->domainName(),
            'account_status_id' => 1,
            'is_verified' => 1,
            'business_category_id' => mt_rand(1, 10),
            'membership_id' => 1,
            'star_5' => $star_5,
            'star_4' => $star_4,
            'star_3' => $star_3,
            'star_2' => $star_2,
            'star_1' => $star_1,
            'review_general' => $general,
            'review_complaint' => $complaint,
            'review_solution' => $solution,

        ];

    }
}
