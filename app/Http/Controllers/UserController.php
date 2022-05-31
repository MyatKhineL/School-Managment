<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('view', auth()->user());
        return view('user.index');
    }

    public function ssd(Request $request)
    {
        Gate::authorize('view', auth()->user());
        $users = User::latest()->get();
        return DataTables::of($users)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('profile_img', function ($each) {
                return '<img src="' . $each->profile_img_path() . '" alt="" class="border border-1 border-white shadow-sm profile-thumb" />';
            })
            ->editColumn('join_date', function ($each) {
                return Carbon::parse($each->date_of_join)->format('d M Y');
            })
            ->editColumn('usertype', function ($each) {
                return $each->usertype ? $each->usertype : '-';
            })
            ->addColumn('dep', function($each){
                return $each->department ? $each->department->name : '-';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

               if (auth()->user()->usertype == 'admin') {
                $edit = '<a href="'.route('user.edit', $each->id).'" class="btn mr-1 btn-success btn-sm rounded-circle"><i class="fa-solid fa-pen-to-square fw-light"></i></a>';
               }

               if (auth()->user()->usertype == 'admin') {
                $detail = '<a href="' . route('user.show', $each->id) . '" class="btn mr-1 btn-info btn-sm rounded-circle"><i class="fa-solid fa-circle-info"></i></a>';
               }

               if(auth()->user()->usertype == 'admin'){
                $del = '<a href="#" class="btn btn-danger btn-sm rounded-circle del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt fw-light"></i></a>';
               }

                return '<div class="action-icon text-nowrap">' . $edit . $detail . $del . '</div>';
            })
            // ->filterColumn('dept', function($query, $keyword){
            //     $query->whereHas('department', function ($q) use ($keyword) {
            //         $q->where('name', 'like', "%$keyword%");
            //     });
            // })
            ->rawColumns(['action', 'profile_img'])
            ->make(true);
    }

    public function create()
    {
        Gate::authorize('create', auth()->user());
        $courses = Course::latest()->get();
        return view('user.create', compact('courses'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->id_no = $request->id_no;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->nrc_number = $request->nrc;
        $user->mname = $request->mname;
        $user->fname = $request->fname;
        $user->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $user->date_of_join = Carbon::parse($request->date_of_join)->format('Y-m-d');
        $user->gender = $request->gender;
        $user->usertype = $request->usertype;
        $user->department_id = $request->department_id;
        $user->address = $request->address;

        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('profile/' . $newName, file_get_contents($file));

            $user->profile_photo = $newName;
        }

        $user->save();

        return redirect()->route('user.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Employee is successfully created']);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        Gate::authorize('view', $user);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        Gate::authorize('update', $user);
        return view('user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('profile_photo')) {
            Storage::disk('public')->delete('profile/' . $user->profile_photo);
            $file = $request->file('profile_photo');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('profile/' . $newName, file_get_contents($file));

            $user->profile_photo = $newName;
        }

        $user->id_no = $request->id_no;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password ? Hash::make($request->password) : $user->password;
        $user->phone = $request->phone;
        $user->nrc_number = $request->nrc;
        $user->mname = $request->mname;
        $user->fname = $request->fname;
        $user->birthday = Carbon::parse($request->birthday)->format('Y-m-d');
        $user->date_of_join = Carbon::parse($request->date_of_join)->format('Y-m-d');
        $user->gender = $request->gender;
        $user->usertype = $request->usertype;
        $user->department_id = $request->department_id;
        $user->address = $request->address;
        $user->update();

        return redirect()->route('user.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'User is successfully updated']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Gate::authorize('delete', $user);
        Storage::disk('public')->delete('profile/' . $user->profile_photo);
        return $user->delete();
    }

}
