<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];
    protected $table = "specializations";
    public $translatable = ['name'];
    public function teachers (){
        return $this->hasMany(Teacher::class);
    }
}
