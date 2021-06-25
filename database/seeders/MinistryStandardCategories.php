<?php

namespace Database\Seeders;

use App\Models\MinistryStandardCategory;
use Illuminate\Database\Seeder;

class MinistryStandardCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $msc = new MinistryStandardCategory;
        $msc->msc_id = 1;
        $msc->msc_name = "Bachelor's degree level standards";
        $msc->save();

        $msc2 = new MinistryStandardCategory;
        $msc2->msc_id = 2;
        $msc2->msc_name = "Master's degree level standards";
        $msc2->save();

        $msc3 = new MinistryStandardCategory;
        $msc3->msc_id = 3;
        $msc3->msc_name = "Doctoral degree level standards";
        $msc3->save();
    }
}
