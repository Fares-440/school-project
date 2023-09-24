<?php


namespace App\Repository;

use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $processing_fees = ProcessingFee::all();
        return view('pages.processing_fee.index',compact('processing_fees'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        // dd($student->studentAccount);
        return view('pages.processing_fee.add',compact('student'));
    }

    public function edit($id)
    {
        $processing_fee = ProcessingFee::findorfail($id);
        return view('pages.processing_fee.edit',compact('processing_fee'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $processing_fee = new ProcessingFee();
            $processing_fee->date = date('Y-m-d');
            $processing_fee->student_id = $request->student_id;
            $processing_fee->amount = $request->debit;
            $processing_fee->description = $request->description;
            $processing_fee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $processing_fee->id;
            $students_accounts->debit = 0.00;
            $students_accounts->credit = $request->debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('processing_fee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $processing_fee = ProcessingFee::findorfail($request->id);;
            $processing_fee->date = date('Y-m-d');
            $processing_fee->student_id = $request->student_id;
            $processing_fee->amount = $request->debit;
            $processing_fee->description = $request->description;
            $processing_fee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('processing_id',$request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $processing_fee->id;
            $students_accounts->debit = 0.00;
            $students_accounts->credit = $request->debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('processing_fee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            ProcessingFee::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
