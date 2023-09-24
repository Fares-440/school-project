<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function from_Grade()
    {
        return $this->belongsTo(Grade::class, 'from_grade');
    }
    public function from_classroom()
    {
        return $this->belongsTo(Classroom::class, 'from_Classroom');
    }
    public function from_section()
    {
        return $this->belongsTo(Section::class, 'from_section');
    }
    public function to_grade()
    {
        return $this->belongsTo(Grade::class, 'to_grade');
    }
    public function to_classroom()
    {
        return $this->belongsTo(Classroom::class, 'to_Classroom');
    }
    public function to_section()
    {
        return $this->belongsTo(Section::class, 'to_section');
    }
}
