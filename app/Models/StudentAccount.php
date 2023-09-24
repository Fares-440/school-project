<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function feeInvoices(){
        return $this->belongsTo(FeeInvoices::class, 'fee_invoice_id');
    }
}
