<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i=0; $i <50; $i++){
            $employee = new Employee();
            $employee->name = $faker->name;
            $employee->email = $faker->unique()->email;
            $employee->contactNo =  $faker->unique()->phoneNumber('+91##########');
            $employee->save();
        }
    }
}
