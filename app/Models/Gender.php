<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gender extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];
    protected $table = "genders";
    public $translatable = ['name'];

    public function teachers (){
        return $this->hasMany(Teacher::class);
    }
    public function students (){
        return $this->hasMany(Student::class);
    }
}
