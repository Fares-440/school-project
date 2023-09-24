<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasFactory, HasTranslations, SoftDeletes;
    protected $guard = 'student';
    protected $guarded = [];
    protected $table = "students";
    public $translatable = ['name'];

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function grade()
    {
        return $this->belongsTo(grade::class);
    }
    public function classroom()
    {
        return $this->belongsTo(classroom::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    // علاقة بين الطلاب والجنسيات  لجلب اسم الجنسية  في جدول الجنسيات
    public function nationalitie()
    {
        return $this->belongsTo(Nationalitie::class);
    }
    public function blood()
    {
        return $this->belongsTo(TypeBlood::class);
    }
    // علاقة بين الطلاب والاباء لجلب اسم الاب في جدول الاباء
    public function parent()
    {
        return $this->belongsTo(MyParent::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
    // علاقة بين جدول سدادت الطلاب وجدول الطلاب لجلب اجمالي المدفوعات والمتبقي
    public function studentAccount()
    {
        return $this->hasMany(StudentAccount::class);
    }
    public function studentPayment()
    {
        return $this->hasMany(PaymentStudent::class);
    }
    // علاقة بين جدول الطلاب وجدول الحضور والغياب
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
