<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStudentRequest;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\PaymentStudent;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{

    protected PaymentRepositoryInterface $paymentStudent;


    public function __construct(PaymentRepositoryInterface $paymentStudent)
    {
        $this->paymentStudent = $paymentStudent;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->paymentStudent->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function store(PaymentStudentRequest $request)
    {
        return $this->paymentStudent->store($request);
    }


    public function show(Request $request, $id)
    {
        return $this->paymentStudent->show($id);
    }

    public function edit(Request $request, $id)
    {
        return $this->paymentStudent->edit($id);
    }


    public function update(Request $request)
    {
        return $this->paymentStudent->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->paymentStudent->destroy($request);
    }
}
