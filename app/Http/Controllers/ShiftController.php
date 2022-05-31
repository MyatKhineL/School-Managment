<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreShiftRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UpdateShiftRequest;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('view', auth()->user());
        return view('setup.shift.index');
    }

    public function ssd(Request $request)
    {
        $shifts = Shift::query();
        return DataTables::of($shifts)
            // ->addColumn('plus-icon', function ($each) {
            //     return null;
            // })
            ->addColumn('action', function ($each) {
                $edit = "";
                $del = "";

                $edit = '<a href="'.route('shift.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';

                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';

                return '<div class="action-icon">' . $edit  . $del. '</div>';
            })
            ->editColumn('start_time', function ($each) {
                return Carbon::parse($each->start_time)->format('h:i:s a');
            })
            ->editColumn('end_time', function ($each) {
                return Carbon::parse($each->end_time)->format('h:i:s a');
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create', auth()->user());
        return view('setup.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreShiftRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShiftRequest $request)
    {
        Gate::authorize('create', auth()->user());
        $currentDate = date("Y-m-d");
        $shift = new Shift();
        $shift->name = $request->name;
        $shift->start_time = $currentDate . ' ' . $request->start_time;
        $shift->end_time =$currentDate . ' ' . $request->end_time;
        $shift->save();

        return redirect()->route('shift.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $shift->name . ' is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        Gate::authorize('update', auth()->user());
        return view('setup.shift.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateShiftRequest  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShiftRequest $request, Shift $shift)
    {
        Gate::authorize('update', auth()->user());
        $currentDate = date("Y-m-d");
        $shift->name = $request->name;
        $shift->start_time = $currentDate . ' ' . $request->start_time;
        $shift->end_time =$currentDate . ' ' . $request->end_time;
        $shift->update();

        return redirect()->route('shift.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully UPdated', 'message' => $shift->name . ' is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        Gate::authorize('delete', auth()->user());
        return $shift->delete();
    }
}
