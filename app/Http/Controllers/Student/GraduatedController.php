<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Interfaces\StudentGraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $graduated;

    public function __construct(StudentGraduatedRepositoryInterface $graduated)
    {
        $this->graduated = $graduated;
    }

    public function index()
    {
        return $this->graduated->index();
    }

    public function create()
    {
        return $this->graduated->create();
    }

    public function store(Request $request)
    {
        return $this->graduated->softDelete($request);
    }

    public function update(Request $request)
    {
        return $this->graduated->returnData($request);
    }

    public function destroy(Request $request)
    {
        return $this->graduated->destroy($request);
    }
}
