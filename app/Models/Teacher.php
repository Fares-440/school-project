<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasFactory, HasTranslations;
    protected $guarded = [];
    protected $guard = 'teacher';
    protected $table = "teachers";
    public $translatable = ['name'];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'teacher_section');
    }
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
