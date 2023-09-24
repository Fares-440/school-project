<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];
    protected $table = "classrooms";
    public $translatable = ['name'];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
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
        return $this->hasMany(Promotion::class);
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
