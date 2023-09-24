<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Authenticatable
{
    use HasFactory, HasTranslations;
    // protected $guard = 'parent';
    public $translatable = ['father_name', 'job_father', 'mother_name', 'job_mother'];
    protected $guarded = [];
    protected $table = 'parents';

    public function photos()
    {
        return $this->hasMany(ParentAttachment::class, 'parent_id', 'id');
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
