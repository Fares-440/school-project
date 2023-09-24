<?php

namespace App\Http\Controllers\Quizzes;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizzeRequest;
use App\Interfaces\QuizzRepositoryInterface;
use App\Models\Quizze;
use Illuminate\Http\Request;

class QuizzeController extends Controller
{
    protected $quizze;

    public function __construct(QuizzRepositoryInterface $quizze)
    {
        $this->quizze = $quizze;
    }

    public function index()
    {
        return $this->quizze->index();
    }

    public function create()
    {
        return $this->quizze->create();
    }


    public function store(QuizzeRequest $request)
    {
        return $this->quizze->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->quizze->edit($id);
    }

    public function update(QuizzeRequest $request)
    {
        return $this->quizze->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->quizze->destroy($request);
    }
}
