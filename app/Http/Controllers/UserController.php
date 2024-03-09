<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfile(){

        $data['fetchedRecord'] = User::getRecByID(Auth::user()->id);


        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Admin Profile';
            return view('profile.profile', $data);

        } else {
            
            abort(404);
        }

    }

    public function show_change_password(){

        $data['headerTitle'] = 'Change Password';
        return view('profile.change_password', $data);
    }

    public function update_change_password(Request $request){

        $user = User::getRecByID(Auth::user()->id);

        if (Hash::check($request->old_password, $user->password)) {
            
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Password Changes Successfully!');
        }
        else{

            return redirect()->back()->with('error', 'Old Password is Incorrect!');
        }
    }

    public function show_change_prof_pic(){

        $data['headerTitle'] = 'Change Profile Picture';
        return view('profile.change_prof_pic', $data);
    }

    public function update_change_prof_pic(Request $request){

        $user = User::getRecByID(Auth::user()->id);

        if (!empty($request->file('prof_pic'))) {
            
            $file = $request->file('prof_pic');
            $extension = $file->getClientOriginalExtension();

            $fileName = $user->emp_id . '_' . date("Ymd").time() . '.' . $extension;

            $file->move('uploads/profile_img/', $fileName);

            $user->prof_pic = $fileName;

            $user->save();

            return redirect()->back()->with('success', 'Profile Picture Changed Successfully!');

        }
        else{

            return redirect()->back()->with('error', 'Please Choose a Picture!');
        }


    }
}
