<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileInfoRequest;
use App\Http\Requests\UpdateProfilePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function updateProfileInfo(UpdateProfileInfoRequest $request)
    {
       $user = User::findOrFail(Auth::id());
       $user->name = $request->name;
       $user->email = $request->email;
       $user->phone = $request->phone;
       $user->address = $request->address;
       $user->update();

       return redirect()->back()->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'User info is successfully updated']);
    }

    public function changePassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(UpdateProfilePasswordRequest $request)
    {
        $user = new User();
        $currentUser = $user->find(Auth::id());
        $currentUser->password = Hash::make($request->new_password);
        $currentUser->update();
        Auth::logout();

        return redirect()->route('login');
    }
}
