<?php
namespace Database\Seeders;
use App\Models\User;
use Database\Seeders\GenderSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\ClassroomSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\ParentSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\StudentSeeder;
use Database\Seeders\NationalitiesSeeder;
use Database\Seeders\ReligionSeeder;
use Database\Seeders\SpecialzationsSeeder;
use Database\Seeders\TypeBloodSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        User::create([
            'name' => 'fares',
            'email' => 'fares@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $this->call(NationalitiesSeeder::class);
        $this->call(ReligionSeeder::class);
        $this->call(TypeBloodSeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ParentSeeder::class);
        $this->call(SpecialzationsSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
