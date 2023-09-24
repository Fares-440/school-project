<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\PromotionRequest;
use App\Interfaces\StudentPromotionRepositoryInterface;
use App\Models\Grade;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    protected StudentPromotionRepositoryInterface $promotion;

    public function __construct(StudentPromotionRepositoryInterface $promotion)
    {
        $this->promotion = $promotion;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grades = Grade::all();
        return view('pages.students.promotions.index', compact('grades'));
    }

    public function create()
    {
        return view('pages.students.promotions.management')->with([
            'promotions' => Promotion::with(
                    'student',
                    'from_grade',
                    'from_Classroom',
                    'from_section',
                    'to_grade',
                    'to_Classroom',
                    'to_section',
                )->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionRequest $request)
    {
        return $this->promotion->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return $this->promotion->destroy($request);
    }
}
