<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Interfaces\StudentRepositoryInterface;
use App\Models\Image;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected StudentRepositoryInterface $student;

    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.students.index')->with([
            'students' => $this->student->getAllStudents()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.students.add')->with([
            'genders' => $this->student->genders(),
            'grades' => $this->student->grades(),
            'nationalitie' => $this->student->nationalitie(),
            'bloods' => $this->student->bloods(),
            'parents' => $this->student->parents(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        // StudentRequest
        return  $this->student->store($request);
    }


    public function show(Request $request, $id)
    {

        return view('pages.students.show')->with([
            'student' => $this->student->show($id),
        ]);
    }


    public function edit(Request $request, $id)
    {
        return view('pages.students.edit')->with([
            'student' => $this->student->edit($id),
            'genders' => $this->student->genders(),
            'grades' => $this->student->grades(),
            'nationalities' => $this->student->nationalitie(),
            'bloods' => $this->student->bloods(),
            'parents' => $this->student->parents(),
        ]);
    }


    public function update(StudentRequest $request, $id)
    {
        return $this->student->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->student->destory($request);
    }
    public function getImage($file, $name)
    {
        return $this->student->getImage($file, $name);
    }
    public function downloadImage($file, $name)
    {
        return $this->student->downloadImage($file, $name);
    }
    public function deleteImage(Request $request)
    {
        return $this->student->deleteImage($request);
    }
    public function uploadImage(Request $request)
    {
        return $this->student->uploadImage($request);
    }
}
