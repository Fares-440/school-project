<?php

namespace Database\Seeders;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'email' => 'fares@gmail.com',
                'password' => Hash::make('123456789'),
                'name' =>  [
                    'ar' => 'فارس', 'en' => 'fares',
                ],
                'specialization_id' => Specialization::all()->random()->id,
                'gender_id' => 1,
                'joining_date' => '2021-04-11',
                'address' => 'yemen',
            ],
            [
                'email' => 'ali@gmail.com',
                'password' => Hash::make('123456789'),
                'name' =>  [
                    'ar' => 'علي', 'en' => 'ali',
                ],
                'specialization_id' => Specialization::all()->random()->id,
                'gender_id' => 1,
                'joining_date' => '2021-04-11',
                'address' => 'yemen',
            ],
            [
                'email' => 'jska@gmail.com',
                'password' => Hash::make('123456789'),
                'name' =>  [
                    'ar' => 'جسكا', 'en' => 'jska',
                ],
                'specialization_id' => Specialization::all()->random()->id,
                'gender_id' => 2,
                'joining_date' => '2021-04-11',
                'address' => 'yemen',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
