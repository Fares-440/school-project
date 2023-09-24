<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //date('Y')

        $students = [
            [
                'name' => [
                    'ar' => 'سامي',
                    'en' => 'samee'
                ],
                'email' => 'samee@gmail.com',
                'password' => Hash::make('123456789'),
                'gender_id' => 1,
                'nationalitie_id' => Nationalitie::all()->random()->id,
                'blood_id' => TypeBlood::all()->random()->id,
                'date_birth' => '2020-01-1',
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'parent_id' => MyParent::all()->random()->id,
                'academic_year' => date('Y'),
            ],
            [
                'name' => [
                    'ar' => 'علي',
                    'en' => 'ali'
                ],
                'email' => 'ali@gmail.com',
                'password' => Hash::make('123456789'),
                'gender_id' => 1,
                'nationalitie_id' => Nationalitie::all()->random()->id,
                'blood_id' => TypeBlood::all()->random()->id,
                'date_birth' => '2020-01-1',
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'parent_id' => MyParent::all()->random()->id,
                'academic_year' => date('Y'),
            ],
            [
                'name' => [
                    'ar' => 'فيصل',
                    'en' => 'fisal'
                ],
                'email' => 'fisal@gmail.com',
                'password' => Hash::make('123456789'),
                'gender_id' => 1,
                'nationalitie_id' => Nationalitie::all()->random()->id,
                'blood_id' => TypeBlood::all()->random()->id,
                'date_birth' => '2020-01-1',
                'grade_id' => 1,
                'classroom_id' => 1,
                'section_id' => 1,
                'parent_id' => MyParent::all()->random()->id,
                'academic_year' => date('Y'),
            ],
            [
                'name' => [
                    'ar' => 'اسامة',
                    'en' => 'osama'
                ],
                'email' => 'osama@gmail.com',
                'password' => Hash::make('123456789'),
                'gender_id' => 1,
                'nationalitie_id' => Nationalitie::all()->random()->id,
                'blood_id' => TypeBlood::all()->random()->id,
                'date_birth' => '2020-03-1',
                'grade_id' => 2,
                'classroom_id' => 2,
                'section_id' => 2,
                'parent_id' => MyParent::all()->random()->id,
                'academic_year' => date('Y'),
            ],
            [
                'name' => [
                    'ar' => 'فاطمة',
                    'en' => 'fatima'
                ],
                'email' => 'fatima@gmail.com',
                'password' => Hash::make('123456789'),
                'gender_id' => 2,
                'nationalitie_id' => Nationalitie::all()->random()->id,
                'blood_id' => TypeBlood::all()->random()->id,
                'date_birth' => '2020-04-1',
                'grade_id' => 3,
                'classroom_id' => 3,
                'section_id' => 3,
                'parent_id' => MyParent::all()->random()->id,
                'academic_year' => date('Y'),
            ],

        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
