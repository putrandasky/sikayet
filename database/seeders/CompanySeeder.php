<?php

namespace Database\Seeders;

use App;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            # code...
            App\Models\Company::factory()->create();
        }

    }
}
