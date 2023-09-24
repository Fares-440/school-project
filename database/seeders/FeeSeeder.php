<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fees = [
            [
                'title' => ['en' => 'school money', 'ar' => 'رسوم دراسية'],
                'amount' => 10000,
                'grade_id' => 1,
                'classroom_id' => 1,
                'year' => Date('Y'),
                'fee_type' => 1
            ],
            [
                'title' => ['en' => 'bus money', 'ar' => 'رسوم باص'],
                'amount' => 2000,
                'grade_id' => 1,
                'classroom_id' => 1,
                'year' => Date('Y'),
                'fee_type' => 2
            ],

        ];
        foreach ($fees as $fee) {
            Fee::create($fee);
        }
    }
}
