<?php

namespace Database\Seeders;

use App\Models\MSOutcomeMap;
use Illuminate\Database\Seeder;

class MSOutcomeMapSeederTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $map = new MSOutcomeMap;
        $map->ministry_standard_id = 1;
        $map->l_outcome_id = 2;
        $map->map_scale_value = 'D';
        $map->save();

        $map2 = new MSOutcomeMap;
        $map2->ministry_standard_id = 2;
        $map2->l_outcome_id = 5;
        $map2->map_scale_value = 'I';
        $map2->save();
    }
}
