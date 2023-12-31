<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoices extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
    public function fee(){
        return $this->belongsTo(Fee::class, 'fee_id');
    }
}
