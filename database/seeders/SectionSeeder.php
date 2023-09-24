<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'name' => [
                    'ar' => 'العلمي',
                    'en' => 'sicence',
                ],
                'grade_id' => 1,
                'classroom_id' => 1
            ],
            [
                'name' => [
                    'ar' => 'ادبي',
                    'en' => 'degs',
                ],
                'grade_id' => 1,
                'classroom_id' => 2
            ],
            [
                'name' => [
                    'ar' => 'طبي',
                    'en' => 'deocotr',
                ],
                'grade_id' => 2,
                'classroom_id' => 3
            ],
            [
                'name' => [
                    'ar' => '5العلمي',
                    'en' => 'sicence',
                ],
                'grade_id' => 2,
                'classroom_id' => 4
            ],
            [
                'name' => [
                    'ar' => '5ادبي',
                    'en' => 'degs',
                ],
                'grade_id' => 3,
                'classroom_id' => 5
            ],
            [
                'name' => [
                    'ar' => '5طبي',
                    'en' => 'deocotr',
                ],
                'grade_id' => 3,
                'classroom_id' => 6
            ],
        ];
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
