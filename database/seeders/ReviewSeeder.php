<?php

namespace Database\Seeders;

use App;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 20; $i++) {
            $min = mt_rand(58, 70);
            for ($a = $min; $a < mt_rand(200, 234); $a++) {
                App\Models\Review::factory()->create([
                    'user_id' => $i,
                    'company_id' => $a,
                ]);
            }
        }

    }
}
