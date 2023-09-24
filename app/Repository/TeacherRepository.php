<?php

namespace App\Repository;

use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return Teacher::with('gender', 'specialization')->get();
    }
    public function specializations()
    {
        return Specialization::all();
    }
    public function genders()
    {
        return Gender::all();
    }
    public function store($teacher)
    {

        $teacher =  Teacher::create([
            'email' => $teacher->email,
            'password' => Hash::make($teacher->password),
            'name' => [
                'ar' => $teacher->name['ar'],
                'en' => $teacher->name['en'],
            ],
            'specialization_id' => $teacher->specialization_id,
            'gender_id' => $teacher->gender_id,
            'joining_date' => $teacher->joining_date,
            'address' => $teacher->address,
        ]);
        if ($teacher) {
            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.index');
        }
        toastr()->success(trans('هنالك خظاء ما'));
        return redirect()->route('teachers.index');
    }
    public function edit($id)
    {
        return Teacher::with('gender', 'specialization')->find($id);
    }
    public function update($teacher)
    {
        $teacher =  Teacher::whereId($teacher->id)->update([
            'email' => $teacher->email,
            'password' => Hash::make($teacher->password),
            'name' => [
                'ar' => $teacher->name['ar'],
                'en' => $teacher->name['en'],
            ],
            'specialization_id' => $teacher->specialization_id,
            'gender_id' => $teacher->gender_id,
            'joining_date' => $teacher->joining_date,
            'address' => $teacher->address,
        ]);
        if ($teacher) {
            toastr()->success(trans('messages.Update'));
            return redirect()->route('teachers.index');
        };
        toastr()->success(trans('هنالك خظاء ما'));
        return redirect()->route('teachers.index');
    }
    public function destory($id)
    {
        $teacher = Teacher::destroy($id);
        if ($teacher) {
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('teachers.index');
        };
        toastr()->success(trans('هنالك خظاء ما'));
        return redirect()->route('teachers.index');
    }
}
