<?php

namespace App\Repository;

use App\Interfaces\StudentPromotionRepositoryInterface;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository  implements StudentPromotionRepositoryInterface
{

    public function store($request)
    {

        DB::beginTransaction();
        try {

            $students = Student::where('grade_id', $request->grade_id)->where('classroom_id',   $request->classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();
            if ($students->count() < 1) {
                toastr()->error(__('لاتوجد بيانات في جدول الطلاب'));
                return redirect()->back();
            }
            // update in table student
            foreach ($students as $student) {
                $ids = explode(',', $student->id);
                Student::whereIn('id', $ids)
                    ->update([
                        'grade_id' => $request->grade_id_new,
                        'classroom_id' => $request->classroom_id_new,
                        'section_id' => $request->section_id_new,
                        'academic_year' => $request->academic_year_new,
                    ]);
                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_classroom' => $request->classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->grade_id_new,
                    'to_classroom' => $request->classroom_id_new,
                    'to_section' => $request->section_id_new,
                    'academic_year' => $request->academic_year,
                    'academic_year_new' => $request->academic_year_new,
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if ($request->page_id == 1) {

                $promotions = Promotion::all();
                foreach ($promotions as $promotion) {

                    //التحديث في جدول الطلاب
                    $ids = explode(',', $promotion->student_id);
                    student::whereIn('id', $ids)
                        ->update([
                            'grade_id' => $promotion->from_grade,
                            'classroom_id' => $promotion->from_Classroom,
                            'section_id' => $promotion->from_section,
                            'academic_year' => $promotion->academic_year,
                        ]);
                    //حذف جدول الترقيات
                    Promotion::query()->delete();
                }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            } else {
                $promotion = Promotion::findorfail($request->id);
                Student::whereId($promotion->student_id)->update([
                    'grade_id' => $promotion->from_grade,
                    'classroom_id' => $promotion->from_Classroom,
                    'section_id' => $promotion->from_section,
                    'academic_year' => $promotion->academic_year,
                ]);
                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
