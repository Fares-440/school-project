<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessingFeeRequest;
use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Models\ProcessingFee;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{

    protected ProcessingFeeRepositoryInterface $processing_fee;

    public function __construct(ProcessingFeeRepositoryInterface $processing_fee)
    {
        $this->processing_fee = $processing_fee;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->processing_fee->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProcessingFeeRequest $request)
    {
        return $this->processing_fee->store($request);
    }


    public function show(Request $request, $id)
    {
        return $this->processing_fee->show($id);
    }


    public function edit(Request $request, $id)
    {
        return $this->processing_fee->edit($id);
    }


    public function update(ProcessingFeeRequest $request)
    {
        return $this->processing_fee->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->processing_fee->destroy($request);
    }
}
