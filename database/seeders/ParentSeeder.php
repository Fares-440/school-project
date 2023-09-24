<?php

namespace Database\Seeders;

use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parents =
            [
                [
                    'email' => 'fares@gmail.com',
                    'password' => Hash::make('123456789'),
                    'father_name' => [
                        'ar' => 'فارس', 'en' => 'fares',
                    ],
                    'national_id_father' => '8784878877',
                    'passport_id_father' =>  '8784878877',
                    'phone_father' =>  '8784878877',
                    'job_father' => [
                        'ar' => 'مبرمج', 'en' => 'developer',
                    ],
                    'father_nationality_id' => Nationalitie::all()->random()->id,
                    'father_bloodtype_id' => TypeBlood::all()->random()->id,
                    'father_religion_id' => Religion::all()->random()->id,
                    'father_address' => 'sana\'a',
                    'mother_name' => [
                        'ar' => 'انا', 'en' => 'inna',
                    ],
                    'national_id_mother' => '8787873477',
                    'passport_id_mother' => '8787873477',
                    'phone_mother' => '8787873477',
                    'job_mother' => [
                        'ar' => 'مغنية', 'en' => 'singer',
                    ],
                    'mother_nationality_id' => Nationalitie::all()->random()->id,
                    'mother_bloodtype_id' =>  TypeBlood::all()->random()->id,
                    'mother_religion_id' => Religion::all()->random()->id,
                    'mother_address' => 'in sana\'a',
                ],
                [
                    'email' => 'ali@gmail.com',
                    'password' => Hash::make('123456789'),
                    'father_name' => [
                        'ar' => 'علي', 'en' => 'ali',
                    ],
                    'national_id_father' => '8784678877',
                    'passport_id_father' =>  '8784678877',
                    'phone_father' =>  '8784678877',
                    'job_father' => [
                        'ar' => 'دكتور', 'en' => 'doctor',
                    ],
                    'father_nationality_id' => Nationalitie::all()->random()->id,
                    'father_bloodtype_id' => TypeBlood::all()->random()->id,
                    'father_religion_id' => Religion::all()->random()->id,
                    'father_address' => 'sana\'a',
                    'mother_name' => [
                        'ar' => 'جميلة', 'en' => 'jamila',
                    ],
                    'national_id_mother' => '8784678877',
                    'passport_id_mother' => '8784678877',
                    'phone_mother' => '8784678877',
                    'job_mother' => [
                        'ar' => 'ممرضة', 'en' => 'niros',
                    ],
                    'mother_nationality_id' => Nationalitie::all()->random()->id,
                    'mother_bloodtype_id' =>  TypeBlood::all()->random()->id,
                    'mother_religion_id' => Religion::all()->random()->id,
                    'mother_address' => 'in sana\'a',
                ],
                [
                    'email' => 'tom@gmail.com',
                    'password' => Hash::make('123456789'),
                    'father_name' => [
                        'ar' => 'توم', 'en' => 'tom',
                    ],
                    'national_id_father' => '8733878877',
                    'passport_id_father' =>  '8733878877',
                    'phone_father' =>  '8733878877',
                    'job_father' => [
                        'ar' => 'طيار', 'en' => 'pilote',
                    ],
                    'father_nationality_id' => Nationalitie::all()->random()->id,
                    'father_bloodtype_id' => TypeBlood::all()->random()->id,
                    'father_religion_id' => Religion::all()->random()->id,
                    'father_address' => 'sana\'a',
                    'mother_name' => [
                        'ar' => 'تريس', 'en' => 'trise',
                    ],
                    'national_id_mother' => '8733878877',
                    'passport_id_mother' => '8733878877',
                    'phone_mother' => '8733878877',
                    'job_mother' => [
                        'ar' => 'مدرسة', 'en' => 'teacher',
                    ],
                    'mother_nationality_id' => Nationalitie::all()->random()->id,
                    'mother_bloodtype_id' =>  TypeBlood::all()->random()->id,
                    'mother_religion_id' => Religion::all()->random()->id,
                    'mother_address' => 'in sana\'a',
                ],
            ];

        foreach ($parents as $parent) {
            MyParent::create($parent);
        }
    }
}
