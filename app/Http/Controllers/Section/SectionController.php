<?php

namespace App\Http\Controllers\Section;

use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.sections.sections')->with([
            'grades' => Grade::with('sections')->get(),
            'sections' => Section::with(['classroom', 'teachers' => function ($q) {
                $q->get(['teacher_id']);
            }])->get(),
            'teachers' => Teacher::all(),
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
    public function store(SectionRequest $request)
    {
        $section = Section::create([
            'name' => [
                "ar" => $request->name['ar'],
                "en" => $request->name['en'],
            ],
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
        ]);
        $section->teachers()->attach($request->teacher_id);

        // Display an info toast with no title
        toastr()->success(trans('messages.success'));
        return redirect()->route('sections.index');
    }

    public function show($id)
    {
        return response()->json([
            'sections' => Section::where('classroom_id', $id)->pluck('name', 'id'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request)
    {
        $section = Section::findOrFail($request->id);
        $section->name = [
            "ar" => $request->name['ar'],
            "en" => $request->name['en'],
        ];
        $section->status = $request->status ? 1 : 0;
        $section->grade_id = $request->grade_id;
        $section->classroom_id = $request->classroom_id;
        $section->save();
        $section->teachers()->sync($request->teacher_id);
        // Display an info toast with no title
        toastr()->success(trans('messages.Update'));
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        Section::whereId($request->id)->Delete();
        // Display an info toast with no title
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('sections.index');
    }
}
