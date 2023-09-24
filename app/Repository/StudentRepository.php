<?php

namespace App\Repository;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationalitie;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentRepository implements StudentRepositoryInterface
{

    public function getAllStudents()
    {
        return Student::with(
            'gender',
            'grade',
            'classroom',
            'section'
        )->paginate(10);
    }
    public function nationalitie()
    {
        return Nationalitie::all();
    }
    public function genders()
    {
        return Gender::all();
    }
    public function grades()
    {
        return Grade::all();
    }
    public function bloods()
    {
        return TypeBlood::all();
    }
    public function parents()
    {
        return MyParent::all();
    }
    public function classes()
    {
        return Classroom::all();
    }
    public function store($request)
    {

        $student =  Student::create([
            'name' => [
                'ar' => $request->name['ar'],
                'en' => $request->name['en'],
            ],
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender_id' => $request->gender_id,
            'nationalitie_id' => $request->nationalitie_id,
            'blood_id' => $request->blood_id,
            'date_birth' => $request->date_birth,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
            'parent_id' => $request->parent_id,
            'academic_year' => $request->academic_year,
        ]);
        if ($request->images) {
            foreach ($request->file('images') as $file) {
                $file->storeAs('students/' . $student->id . "/" . $student->name, $file->getClientOriginalName(), 'images');
                Image::create([
                    'filename' => $file->getClientOriginalName(),
                    'imageable_id' => $student->id,
                    'imageable_type' => 'App\Models\Student'
                ]);
            }
        }
        if ($student) {
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');
        }
        toastr()->success(trans('هنالك خظاء ما'));
        return redirect()->route('students.index');
    }
    public function edit($id)
    {
        return Student::with(
            'gender',
            'blood',
            'classroom',
            'section',
            'parent',
        )->find($id);
    }
    public function update($request)
    {
        $student =  Student::findorfail($request->id);
        if ($student) {
            $student->name = [
                'ar' => $request->name['ar'],
                'en' => $request->name['en'],
            ];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->gender_id = $request->gender_id;
            $student->nationalitie_id = $request->nationalitie_id;
            $student->blood_id = $request->blood_id;
            $student->date_birth = $request->date_birth;
            $student->grade_id = $request->grade_id;
            $student->classroom_id = $request->classroom_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            if ($request->images) {
                foreach ($request->file('images') as $file) {
                    $file->storeAs('students/' . $student->id, $file->getClientOriginalName(), 'images');
                    Image::create([
                        'filename' => $file->getClientOriginalName(),
                        'imageable_id' => $student->id,
                        'imageable_type' => 'App\Models\Student'
                    ]);
                }
            }
            $student->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('students.index');
        }
        toastr()->success(trans('هنالك خظاء ما'));
        return redirect()->route('students.index');
    }
    public function destory($request)
    {
        $student =  Student::findorfail($request->id);
        if ($student) {
            if ($student->images) {
                if (Storage::disk('images')->exists('students/' . $student->id)) {
                    Storage::disk('images')->deleteDirectory('students/' . $student->id);
                }
            }
            $student->images()->delete();
            $student->forceDelete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('students.index');
        };
        toastr()->success(trans('هنالك خظاء ما'));
        return redirect()->route('students.index');
    }

    public function show($id)
    {
        return Student::with([
            'nationalitie', 'gender',
            'grade', 'classroom',
            'section', 'parent',
            'images'
        ])->find($id);
    }

    public function getImage($file, $name)
    {
        $exists = Storage::disk('images')->exists("students/$file/$name");
        if ($exists) {
            $content = Storage::get("images/students/$file/$name");
            //get mime type of image
            $mime = Storage::mimeType("images/students/$file/$name");
            $response = Response::make($content, 200);
            $response->header("Content-Type", $mime);
            // return response
            return $response;
        }
    }
    public function downloadImage($file, $name)
    {
        $exists = Storage::disk('images')->exists("students/$file/$name");
        if ($exists) {
            return Storage::download("images/students/$file/$name");
        }
    }
    public function deleteImage($request)
    {
        $exists = Storage::disk('images')->exists("students/$request->student_id/$request->filename");
        $image = Image::find($request->id);
        if ($exists && $image) {
            Storage::disk('images')->delete("students/$request->student_id/$request->filename");
            $image->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('students.index');
        }
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('students.index');
    }
    public function uploadImage($request)
    {
        $validator = Validator::make($request->all(), [
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:1000',
            'student_id' => 'required',
            'student_name' => 'required',
        ], [
            'images.image' => 'يرجاء ادخال صورة',
            'images.mimes' => 'يرجاء ادخال صورة',
            'images.max' => 'يرجاء ادخال صور بحجم',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        if ($request->images) {
            foreach ($request->file('images') as $file) {
                $file->storeAs('students/' . $request->student_id, $file->getClientOriginalName(), 'images');
                Image::create([
                    'filename' => $file->getClientOriginalName(),
                    'imageable_id' => $request->student_id,
                    'imageable_type' => 'App\Models\Student'
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.index');
        }
    }
}
