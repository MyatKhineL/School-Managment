<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Shift;
use App\Models\Course;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', auth()->user());
        return view('setup.classroom.index');
    }

    public function ssd(Request $request)
    {
        $rooms = Classroom::with(['course', 'shift', 'teacher']);
        return DataTables::of($rooms)
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";
                $detail = "";

               if (auth()->user()->usertype == 'admin') {
                $edit = '<a href="'.route('classroom.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
               }

                $detail = '<a href="' . route('classroom.show', $each->id) . '" class="btn mr-1 btn-info btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

               if (auth()->user()->usertype == 'admin') {
                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';
               }

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
        Gate::authorize('update', auth()->user());
        $courses = Course::latest()->get();
        $shifts = Shift::latest()->get();
        $teachers = User::where('usertype', 'employee')->latest()->get();
        return view('setup.classroom.create', compact('courses', 'shifts', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClassroomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassroomRequest $request)
    {
        Gate::authorize('update', auth()->user());
        $room = new Classroom();
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
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        return view('setup.classroom.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        Gate::authorize('update', auth()->user());
        $courses = Course::latest()->get();
        $shifts = Shift::latest()->get();
        $teachers = User::where('usertype', 'employee')->latest()->get();
        return view('setup.classroom.edit', compact('courses', 'shifts', 'teachers', 'classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassroomRequest  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        Gate::authorize('update', auth()->user());
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
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        Gate::authorize('delete', auth()->user());
        return $classroom->delete();
    }
}
