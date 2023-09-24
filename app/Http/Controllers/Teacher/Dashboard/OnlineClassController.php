<?php

namespace App\Http\Controllers\Teacher\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OnlineClassRequest;
use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassController extends Controller
{
    use MeetingZoomTrait;
    public function index()
    {
        $online_classes = OnlineClass::where('created_by', auth()->user()->email)->get();
        return view('pages.teachers.dashboard.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.teachers.dashboard.online_classes.add', compact('Grades'));
    }


    public function store(OnlineClassRequest $request)
    {
        try {

            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'integration' => true,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                // 'user_id' => auth()->user()->id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_class.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        try {

            $info = OnlineClass::find($request->id);

            if ($info->integration == true) {
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                // online_classe::where('meeting_id', $request->id)->delete();
                OnlineClass::destroy($request->id);
            } else {
                // online_classe::where('meeting_id', $request->id)->delete();
                OnlineClass::destroy($request->id);
            }
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_class.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.teachers.dashboard.online_classes.indirect', compact('Grades'));
    }
    public function storeIndirect(Request $request)
    {
        try {
            OnlineClass::create([
                'integration' => false,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                // 'user_id' => auth()->user()->id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_class.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
