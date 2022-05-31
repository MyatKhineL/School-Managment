<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Shift;
use App\Models\Course;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('setup.classroom.index');
    }

    public function ssd(Request $request)
    {
        $rooms = ClassRoom::with(['course', 'shift', 'teacher']);
        return DataTables::of($rooms)
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";
                $detail = "";

                $edit = '<a href="'.route('classroom.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('classroom.show', $each->id) . '" class="btn mr-1 btn-info btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon">' . $edit . $detail  . $del. '</div>';
            })
            ->addColumn('course', function($each){
                return $each->course ? $each->course->name : '-';
            })
            ->addColumn('shift', function($each){
                return $each->shift ? $each->shift->name : '-';
            })
            ->addColumn('teacher', function($each){
                return $each->teacher ? $each->teacher->name : '-';
            })
            ->editColumn('start_date', function($each){
                return Carbon::parse($each->start_date)->format('d M Y');
            })
            ->editColumn('status', function($each){
                if($each->status == 'open'){
                    return '<span class="text-success font-weight-bold">Open</span>';
                }else{
                    return '<span class="text-danger font-weight-bold">Close</span>';
                }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::latest()->get();
        $shifts = Shift::latest()->get();
        $teachers = User::where('usertype', 'employee')->latest()->get();
        return view('setup.classroom.create', compact('courses', 'shifts', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassRoomRequest $request)
    {
        $room = new ClassRoom();
        $room->name = $request->name;
        $room->status = $request->status;
        $room->shift_id = $request->shift_id;
        $room->course_id = $request->course_id;
        $room->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $room->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $room->user_id = $request->user_id;
        $room->description = $request->description;
        $room->save();

        return redirect()->route('classroom.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $room->name . ' is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classroom)
    {
        return view('setup.classroom.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classroom)
    {
        $courses = Course::latest()->get();
        $shifts = Shift::latest()->get();
        $teachers = User::where('usertype', 'employee')->latest()->get();
        return view('setup.classroom.edit', compact('courses', 'shifts', 'teachers', 'classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassRoomRequest  $request
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassRoomRequest $request, ClassRoom $classroom)
    {
        $classroom->name = $request->name;
        $classroom->status = $request->status;
        $classroom->shift_id = $request->shift_id;
        $classroom->course_id = $request->course_id;
        $classroom->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $classroom->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $classroom->user_id = $request->user_id;
        $classroom->description = $request->description;
        $classroom->update();

        return redirect()->route('classroom.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $classroom->name . ' is successfully update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $classroom)
    {
        return $classroom->delete();
    }
}
