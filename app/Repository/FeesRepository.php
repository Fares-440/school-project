<?php


namespace App\Repository;

use App\Interfaces\FeesRepositoryInterface;
use App\Models\Fee;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface
{

    public function index(){

        $fees = Fee::with('grade', 'classroom')->get();
        $grades = Grade::all();
        return view('pages.fees.index',compact('fees','grades'));

    }

    public function create(){

        $grades = Grade::all();
        return view('pages.fees.add',compact('grades'));
    }

    public function edit($id){
        $fee = Fee::findorfail($id);
        $grades = Grade::all();
        return view('pages.fees.edit',compact('fee','grades'));

    }


    public function store($request)
    {
        try {
            $fees = new Fee();
            $fees->title = ['en' => $request->title['en'], 'ar' => $request->title['ar']];
            $fees->amount  =$request->amount;
            $fees->grade_id  =$request->grade_id;
            $fees->classroom_id  =$request->classroom_id;
            $fees->description  =$request->description;
            $fees->year  =$request->year;
            $fees->fee_type  =$request->fee_type;
            $fees->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('fees.create');

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        try {
            $fees = Fee::findorfail($request->id);
            $fees->title = ['en' => $request->title['en'], 'ar' => $request->title['ar']];
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->grade_id;
            $fees->Classroom_id  =$request->classroom_id;
            $fees->description  =$request->description;
            $fees->year  =$request->year;
            $fees->fee_type  =$request->fee_type;
            $fees->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees.index');
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
