<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Interfaces\FeesRepositoryInterface;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected FeesRepositoryInterface $fee;


    public function __construct(FeesRepositoryInterface $fee)
    {
        $this->fee = $fee;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->fee->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->fee->create();
    }


    public function store(FeeRequest $request)
    {
        return $this->fee->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fee  $fee
     * @return \Illuminate\Http\Response
     */
    public function show(Fee $fee)
    {
        //
    }


    public function edit(Request $request, $id)
    {
        return $this->fee->edit($id);
    }


    public function update(FeeRequest $request)
    {
        return $this->fee->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->fee->destroy($request);
    }
}
