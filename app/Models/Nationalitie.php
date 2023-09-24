<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationalitie extends Model
{
    use HasFactory, HasTranslations;
    public $guarded = [];
    public $translatable = ['name'];
    public function students(){
        return $this->hasMany(Student::class);
    }
}
