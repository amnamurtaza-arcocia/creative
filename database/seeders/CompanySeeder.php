<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Faker\Factory as Faker;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 0; $i<5; $i++){
            $cmp = new Company();
            $cmp->name = $faker->name;
            $cmp->email = $faker->unique->safeEmail();
            $cmp->logo = $faker->image('storage/app/upload',640,480, null, false);
            $cmp->save();
        }

    }
}
