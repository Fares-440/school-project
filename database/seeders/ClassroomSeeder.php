<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classrooms = [
            [
                'name' => [
                    'ar' => 'الاول',
                    'en' => 'first',
                ],
                'grade_id' => 1
            ],
            [
                'name' => [
                    'ar' => 'الثاني',
                    'en' => 'second',
                ],
                'grade_id' =>1
            ],
            [
                'name' => [
                    'ar' => 'الثالث',
                    'en' => 'third',
                ],
                'grade_id' => 2
            ],
            [
                'name' => [
                    'ar' => 'الرابع',
                    'en' => 'fourth',
                ],
                'grade_id' => 2
            ],
            [
                'name' => [
                    'ar' => 'الخامس',
                    'en' => 'fifth',
                ],
                'grade_id' => 3
            ],
            [
                'name' => [
                    'ar' => 'السادس',
                    'en' => 'sixth',
                ],
                'grade_id' => 3
            ],
        ];
        foreach($classrooms as $classroom){
            Classroom::create($classroom);
        }

    }
}
