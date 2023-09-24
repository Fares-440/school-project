<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizzController extends Controller
{


    public function index()
    {
        return view('pages.teachers.dashboard.quizzes.index')->with([
            'quizzes' => Quizze::where('teacher_id', auth()->user()->id)->get()
        ]);
    }


    public function create()
    {
        return view('pages.teachers.dashboard.quizzes.create')->with([
            'grades' => Grade::all(),
            'subjects' => Subject::where('teacher_id', auth()->user()->id)->get()
        ]);
    }


    public function store(Request $request)
    {
        try {
            $quizze = new Quizze();
            $quizze->name = ['en' => $request->name['en'], 'ar' => $request->name['ar']];
            $quizze->subject_id = $request->subject_id;
            $quizze->grade_id = $request->grade_id;
            $quizze->classroom_id = $request->classroom_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = auth()->user()->id;
            $quizze->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizzes.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        return view('pages.teachers.dashboard.quizzes.edit')->with([
            'quizz' => Quizze::findorFail($id),
            'grades' => Grade::all(),
            'subjects' => Subject::where('teacher_id', auth()->user()->id)->get()
        ]);
    }


    public function update(Request $request)
    {
        try {
            $quizze = Quizze::findorFail($request->id);
            $quizze->name = ['en' => $request->name['en'], 'ar' => $request->name['ar']];
            $quizze->subject_id = $request->subject_id;
            $quizze->grade_id = $request->grade_id;
            $quizze->classroom_id = $request->classroom_id;
            $quizze->section_id = $request->section_id;
            $quizze->teacher_id = auth()->user()->id;
            $quizze->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {

        return view('pages.teachers.dashboard.questions.index')->with([
            "questions" => Question::where('quizze_id', $id)->get(),
            "quizze" => Quizze::findorFail($id)
        ]);
    }


    public function destroy($id)
    {
        try {
            Quizze::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function getClassrooms($id)
    {
        return Classroom::where("grade_id", $id)->pluck("name", "id");
    }

    public function getSections($id)
    {
        return Section::where("classroom_id", $id)->pluck("name", "id");
    }
}
