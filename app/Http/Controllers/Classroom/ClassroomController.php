<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.classrooms.classroom')->with([
            'classrooms' => Classroom::with('grade')->paginate(),
            'grades' => Grade::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $validation = Validator::make($request->all(), [
                'list_classes.*.name_ar' => "required|max:255",
                'list_classes.*.name_en' => "required|max:255",
                'list_classes.*.grade_id' => 'required'
            ], [
                'list_classes.*.name_ar.required' => trans('My_Classes_trans.required_ar'),
                'list_classes.*.name_en.required' => trans('My_Classes_trans.required_en'),
                'list_classes.*.grade_id.required' => "يجب ادخال المرحلة",
            ]);
            if ($validation->fails()) {
                return redirect()->route('classrooms.index')->withErrors($validation);
            }
            $list_classes = $request->list_classes;
            foreach ($list_classes as $classroom) {
                Classroom::create([
                    'name' => [
                        'ar' => $classroom['name_ar'],
                        'en' => $classroom['name_en'],
                    ],
                    'grade_id' => $classroom['grade_id']
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('classrooms.index');
        } catch (Exception $e) {
            toastr()->error("$e حدث خطاء ما");
            return redirect()->route('classrooms.index');
        }
    }

    public function show($id)
    {
        return response()->json([
            'classroom' => Classroom::where('grade_id', $id)->pluck('name', 'id'),
        ]);
    }


    public function edit(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request)
    {

        Classroom::whereId($request->id)->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ],
            'grade_id' => $request->grade_id
        ]);
        // Display an info toast with no title
        toastr()->success(trans('messages.Update'));
        return redirect()->route('classrooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $classroom = Classroom::whereDoesntHave('sections')->whereId($request->id)->exists();
        if ($classroom) {
            Classroom::destroy($request->id);
            // Display an info toast with no title
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('classrooms.index');
        }

        toastr()->error(trans('My_Classes_trans.delete_Class_Error'));
        return redirect()->route('classrooms.index');
    }
    public function delete_all(Request $request)
    {
        $all_id = explode(",", $request->delete_all_id);
        Classroom::whereDoesntHave('sections')->whereIn('id', $all_id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('classrooms.index');
    }
    public function filter_classes(Request $request)
    {
        return view('pages.classrooms.classroom')->with([
            'classrooms' => Classroom::with('grade')->whereGrade_id($request->grade_id_filter)->paginate(),
            'grades' => Grade::get(),
        ]);
    }
}
