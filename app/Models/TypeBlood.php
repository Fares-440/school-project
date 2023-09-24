<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeBlood extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function students(){
        return $this->hasMany(Student::class);
    }
}
