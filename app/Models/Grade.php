<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded   = [];
    protected $table = 'grades';
    // public $timestamps = true;
    public $translatable = ['name'];
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function promotions()
    {
        return $this->hasMany(Promotion::class, 'id');
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
