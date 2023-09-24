<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeInvioceRequest;
use App\Interfaces\FeeInvoicesRepositoryInterface;
use App\Models\FeeInvoices;
use Illuminate\Http\Request;

class FeeInvoicesController extends Controller
{

    protected FeeInvoicesRepositoryInterface $feeInvoices;
    public function __construct(FeeInvoicesRepositoryInterface $feeInvoices)
    {
        $this->feeInvoices = $feeInvoices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->feeInvoices->index();
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
    public function store(FeeInvioceRequest $request)
    {
        return $this->feeInvoices->store($request);
    }


    public function show(Request $request, $id)
    {
        return $this->feeInvoices->show($id);
    }


    public function edit($id)
    {
        return $this->feeInvoices->edit($id);
    }


    public function update(Request $request)
    {
        return $this->feeInvoices->update($request);
    }


    public function destroy(Request $request)
    {
        return $this->feeInvoices->destroy($request);
    }
}
