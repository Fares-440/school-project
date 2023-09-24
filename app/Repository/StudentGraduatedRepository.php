<?php

namespace App\Repository;

use App\Interfaces\StudentGraduatedRepositoryInterface;
use App\Models\Grade;
use App\Models\Student;

class StudentGraduatedRepository implements StudentGraduatedRepositoryInterface
{

    public function index()
    {
        return view('pages.students.graduated.index')->with([
            'students' => Student::onlyTrashed()->get()
        ]);
    }

    public function create()
    {
        return view('pages.students.graduated.create')->with([
            'grade' => Grade::all()
        ]);
    }
    public function softDelete($request)
    {

        $students = student::whereGrade_id($request->grade_id)
            ->whereClassroom_id($request->classroom_id)->whereSection_id($request->section_id)->get();
        if ($students->count() < 1) {
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            student::whereIn('id', $ids)->delete();
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('graduated.index');
    }
    public function returnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        if ($request->exit) {
            student::whereId($request->exit)->delete();
            toastr()->success(trans('تم تخرج الطالب بنجاح'));
            return redirect()->back();
        }
        student::onlyTrashed()->whereId($request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}
