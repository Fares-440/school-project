<?php

namespace App\Http\Controllers\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Interfaces\SubjectRepositoryInterface;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subject;

    public function __construct(SubjectRepositoryInterface $subject)
    {
        $this->subject = $subject;
    }

    public function index()
    {
        return $this->subject->index();
    }


    public function create()
    {
        return $this->subject->create();
    }


    public function store(SubjectRequest $request)
    {
        return $this->subject->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->subject->edit($id);
    }

    public function update(SubjectRequest $request)
    {
        return $this->subject->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->subject->destroy($request);
    }
}
