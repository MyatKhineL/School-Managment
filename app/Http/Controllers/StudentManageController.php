<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreStudentManageRequest;
use App\Http\Requests\UpdateStudentManageRequest;

class StudentManageController extends Controller
{
    public function index()
    {
        $students = User::with('rooms')->where('usertype', 'student')->get();
        return view('student-manage.index', compact('students'));
    }

    public function ssd(Request $request)
    {
        $students = User::with('rooms')->where('usertype', 'student');
        return DataTables::of($students)
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail= "";

                $edit = '<a href="'.route('student.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $detail = '<a href="' . route('student.show', $each->id) . '" class="btn mr-1 btn-info btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';

                return '<div class="action-icon">' . $edit  . $detail. '</div>';
            })
            ->addColumn('course', function($each){
                $output ="<div>";
                foreach ($each->rooms as $room) {
                    $output .=  $room->course->name. ', ' . '<br>';
                }

                return $output;
            })
            ->addColumn('room', function($each){
                $output ="<div>";
                foreach ($each->rooms as $room) {
                    $output .=  $room->name. ', ' . '<br>';
                }

                return $output;
            })
            ->rawColumns(['action', 'course', 'room'])
            ->make(true);
    }


    public function create()
    {
        Gate::authorize('create', auth()->user());
        $rooms =  Classroom::latest()->get();
        $students = User::where('usertype', 'student')->latest()->get();
        return view('student-manage.take-course', compact('rooms', 'students'));
    }

    public function storeCourses(StoreStudentManageRequest $request)
    {
        $student = User::findOrFail($request->user_id);
        $student->rooms()->sync($request->rooms);

        return redirect()->route('student.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Added', 'message' => "Add student's course are  successfully"]);
    }

    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('student-manage.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);

        $rooms =  Classroom::latest()->get();
        $old_rooms = $student->rooms->pluck('id')->toArray();
        return view('student-manage.edit', compact('student', 'rooms', 'old_rooms'));
    }

    public function update(UpdateStudentManageRequest $request, $id)
    {
        $student = User::findOrFail($request->user_id);
        $student->rooms()->sync($request->rooms);

        return redirect()->route('student.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => "Add student's course are successfully updated"]);
    }
}
