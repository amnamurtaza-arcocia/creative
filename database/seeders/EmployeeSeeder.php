<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Company;
use Faker\Factory as Faker;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmp_id = Company::pluck('id');
        $faker = Faker::create();
        for($i = 0; $i< count($cmp_id); $i++){
            $emp = new Employee();
            $emp->first_name = $faker->firstName;
            $emp->last_name = $faker->lastName;
            $emp->phone = $faker->unique()->e164PhoneNumber;
            $emp->email = $faker->unique()->safeEmail();
            $emp->company_id = $cmp_id[$i];
            $emp->save();
        }
    }
}
