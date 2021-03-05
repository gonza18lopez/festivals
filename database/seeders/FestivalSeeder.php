<?php

namespace Database\Seeders;

use App\Models\Festival;
use Illuminate\Database\Seeder;

class FestivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Festival::create([
            'name' => 'Awakenings',
            'points' => 90
        ]);

        Festival::create([
            'name' => 'Time Warp',
            'points' => 140
        ]);

        Festival::create([
            'name' => 'Tomorrowland',
            'points' => 50
        ]);
    }
}
