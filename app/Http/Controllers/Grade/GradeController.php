<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('pages.grades.grades')->with([
            'grades' => Grade::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(GradeRequest $request)
    {
        $grade = Grade::where('name->ar', $request->name['ar'])->orWhere("name->en", $request->name['en'])->exists();
        if ($grade) {
            toastr()->error(trans('Grades_trans.exists'));
            return redirect()->back()->withInput($request->all());
        }

        Grade::create([
            'name' => [
                "ar" => $request->name['ar'],
                "en" => $request->name['en'],
            ],
            'notes' => $request->notes
        ]);

        // Display an info toast with no title
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(GradeRequest $request, $id)
    {

        $grade = Grade::where('name->ar', $request->name['ar'])->orWhere("name->en", $request->name['en'])->exists();
        if ($grade) {
            toastr()->error(trans('Grades_trans.exists'));
            return redirect()->route('grades.index');
        }
        Grade::whereId($request->id)->update([
            'name' => [
                'ar' => $request->name['ar'],
                'en' => $request->name['en']
            ],
            'notes' => $request->notes
        ]);
        // Display an info toast with no title
        toastr()->success(trans('messages.Update'));
        return redirect()->route('grades.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $grade = Grade::whereDoesntHave('classrooms')->whereId($request->id)->exists();
        if ($grade) {
            Grade::destroy($request->id);
            // Display an info toast with no title
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('grades.index');
        }

        toastr()->error(trans('Grades_trans.delete_Grade_Error'));
        return redirect()->route('grades.index');
    }
}
