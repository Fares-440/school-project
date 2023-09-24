<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded   = [];
    protected $table = 'sections';
    public $translatable = ['name'];
    public function classroom()
    {
        return $this->belongsTo(Classroom::class,);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_section');
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
