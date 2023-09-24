<?php

namespace App\Http\Controllers\Questions;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected $question;

    public function __construct(QuestionRepositoryInterface $question)
    {
        $this->question = $question;
    }

    public function index()
    {
        return $this->question->index();
    }

    public function create()
    {
        return $this->question->create();
    }

    public function store(QuestionRequest $request)
    {
        return $this->question->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->question->edit($id);
    }

    public function update(QuestionRequest $request)
    {
        return $this->question->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->question->destroy($request);
    }
}
