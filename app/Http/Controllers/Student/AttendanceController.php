<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;

    public function __construct(AttendanceRepositoryInterface $attendance)
    {
        $this->attendance = $attendance;
    }


    public function index()
    {
        return $this->attendance->index();
    }



    public function store(AttendanceRequest $request)
    {
        return $this->attendance->store($request);
    }


    public function show($id)
    {
        return $this->attendance->show($id);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
