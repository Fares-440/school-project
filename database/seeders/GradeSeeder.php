<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $grades = [
            [
                'name' => [
                    'ar' => 'المرحلة الاولى',
                    'en' => 'The first stage',
                ],
                'notes' => 'this is my notes'
            ],
            [
                'name' => [
                    'ar' => 'المرحلة الثانية',
                    'en' => 'The second stage',
                ],
                'notes' => 'this is my notes second'
            ],
            [
                'name' => [
                    'ar' => 'المرحلة الثالثة',
                    'en' => 'The third stage',
                ],
                'notes' => 'this is my notes thierd'
            ]
        ];
        foreach ($grades as  $grade) {
            Grade::create($grade);
        }
    }
}
