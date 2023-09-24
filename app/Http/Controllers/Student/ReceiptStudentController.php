<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReceiptStudentRequest;
use App\Interfaces\ReceiptStudentsRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{

    protected ReceiptStudentsRepositoryInterface $receiptStudent;

    public function __construct(ReceiptStudentsRepositoryInterface $receiptStudent)
    {
        $this->receiptStudent = $receiptStudent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->receiptStudent->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiptStudentRequest $request)
    {
        return $this->receiptStudent->store($request);
    }


    public function show(Request $request, $id)
    {
        return $this->receiptStudent->show($id);
    }

    public function edit(Request $request, $id)
    {
        return $this->receiptStudent->edit($id);
    }


    public function update(ReceiptStudentRequest $request)
    {
        return $this->receiptStudent->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->receiptStudent->destroy($request);
    }
}
