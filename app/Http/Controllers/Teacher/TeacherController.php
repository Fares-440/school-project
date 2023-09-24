<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Models\Teacher;
use App\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
    protected TeacherRepositoryInterface $teacher;
    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher = $teacher;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.teachers.teacher')->with([
            'teachers' => $this->teacher->getAllTeachers()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.teachers.create')->with([
            'specializations' => $this->teacher->specializations(),
            'genders' => $this->teacher->genders()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherRequest $request)
    {
        return $this->teacher->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view('pages.teachers.edit')->with([
            'teacher' => $this->teacher->edit($id),
            'specializations' => $this->teacher->specializations(),
            'genders' => $this->teacher->genders(),
        ]);
    }

    public function update(Request $request)
    // public function update(TeacherRequest $request)
    {
        return $this->teacher->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->teacher->destory($request->id);
    }
}
