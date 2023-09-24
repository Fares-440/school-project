<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\LibraryRequest;
use App\Http\Traits\AttachFilesTrait;
use App\Interfaces\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    use AttachFilesTrait;
    protected $library;

    public function __construct(LibraryRepositoryInterface $library)
    {
        $this->library = $library;
    }

    public function index()
    {
        return $this->library->index();
    }

    public function create()
    {
        return $this->library->create();
    }

    public function store(LibraryRequest $request)
    {
        return $this->library->store($request);
    }

    public function edit($id)
    {
        return $this->library->edit($id);
    }


    public function update(LibraryRequest $request)
    {
        return $this->library->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->library->destroy($request);
    }

    public function downloadAttachment($file, $name)
    {
        return $this->library->download($file, $name);
    }
    public function get_Image($file, $name)
    {
        return $this->getImage("libraryBooks/$file", $name);
    }
}
