<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Interfaces\LibraryRepositoryInterface;
use App\Models\Grade;
use App\Models\Library;
use Illuminate\Support\Facades\Storage;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function store($request)
    {
        try {
            $book = new Library();
            $book->title = $request->title;
            $book->file_name =  $request->file('file_name')->getClientOriginalName();
            $book->grade_id = $request->grade_id;
            $book->classroom_id = $request->classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            $this->uploadFile($request, 'file_name', "libraryBooks/$book->id");

            toastr()->success(trans('messages.success'));
            return redirect()->route('library.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        return view('pages.library.edit', compact('book', 'grades'));
    }

    public function update($request)
    {
        try {
            $book = library::findorFail($request->id);
            $book->title = $request->title;

            if ($request->hasfile('file_name')) {

                $this->deleteFile("libraryBooks/$book->id");
                $this->uploadFile($request, 'file_name', "libraryBooks/$book->id");

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->grade_id = $request->grade_id;
            $book->classroom_id = $request->classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        $library =  library::findorfail($request->id);
        $this->deleteFile("libraryBooks/$library->id");
        library::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('library.index');
    }

    public function download($file, $name)
    {
        $exists = Storage::disk('images')->exists("libraryBooks/$file/$name");
        if ($exists) {
            return Storage::download("images/libraryBooks/$file/$name");
        }
    }
}
