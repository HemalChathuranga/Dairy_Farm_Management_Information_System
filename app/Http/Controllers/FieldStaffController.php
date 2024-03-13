<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FieldStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['fetchedRecord'] = User::getFieldStaffRec();
        $data['headerTitle'] = 'Field Staff List';

        if (Auth::user()->role == 'Admin'){
            return view('admin.fieldStaff.list', $data);
        }
        elseif (Auth::user()->role == 'Manager'){
            return view('manager.fieldStaff.list', $data);
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['headerTitle'] = 'Add New Field Staff';

        if (Auth::user()->role == 'Admin'){
            return view('admin.fieldStaff.add', $data);
        }
        elseif (Auth::user()->role == 'Manager'){
            return view('manager.fieldStaff.add', $data);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'emp_id' => 'required|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'joined_date' => 'required|date',
            'nic' => 'required|string',
            'mobile_number' => 'required|string',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:users',
            'prof_pic' => 'nullable|mimes:png,jpg,jpeg,webp',
            'status' => 'required|string',
            'password' => 'required|string',

        ]);

        $fileName = '0000000000.jpg';

        if ($request->has('prof_pic')) {
            
            $file = $request->file('prof_pic');
            $extension = $file->getClientOriginalExtension();

            $fileName = $request->emp_id . '_' . date("Ymd").time() . '.' . $extension;

            $file->move('uploads/profile_img/', $fileName);
        }

        $user = new User();

        $user->emp_id = trim($request->emp_id);
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->joined_date = $request->joined_date;
        $user->nic = trim($request->nic);
        $user->mobile_number = trim($request->mobile_number);
        $user->address = $request->address;
        $user->email = trim($request->email);

        $user->prof_pic = $fileName;

        $user->role = 'Field Staff';
        $user->status = $request->status;
        $user->password = Hash::make($request->password);

        $user->save();

        if (Auth::user()->role == 'Admin'){
            return redirect('admin/fieldStaff/list')->with('success', 'Field Staff User Created Succesfully');
        }
        elseif (Auth::user()->role == 'Manager'){
            return redirect('manager/fieldStaff/list')->with('success', 'Field Staff User Created Succesfully');
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['fetchedRecord'] = User::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Field Staff User Info.';

            if (Auth::user()->role == 'Admin'){
                return view('admin.fieldStaff.view', $data);
            }
            elseif (Auth::user()->role == 'Manager'){
                return view('manager.fieldStaff.view', $data);
            }
            

        } else {
            
            abort(404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['fetchedRecord'] = User::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Edit Field Staff User Info.';

            if (Auth::user()->role == 'Admin'){
                return view('admin.fieldStaff.edit', $data);
            }
            elseif (Auth::user()->role == 'Manager'){
                return view('manager.fieldStaff.edit', $data);
            }
            

        } else {
            
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'emp_id' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'gender' => 'required|string',
            'joined_date' => 'required|date',
            'nic' => 'required|string',
            'mobile_number' => 'required|string',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'prof_pic' => 'nullable|mimes:png,jpg,jpeg,webp',
            'status' => 'required|string',

        ]);


        $user = User::getRecByID($id);

        // $user->emp_id = trim($request->emp_id); This Should not be updated.
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->joined_date = $request->joined_date;
        $user->nic = trim($request->nic);
        $user->mobile_number = trim($request->mobile_number);
        $user->address = $request->address;
        $user->email = trim($request->email);
        $user->status = $request->status;

        if (!empty($request->file('prof_pic'))) {
            
            $file = $request->file('prof_pic');
            $extension = $file->getClientOriginalExtension();

            $fileName = $request->emp_id . '_' . date("Ymd").time() . '.' . $extension;

            $file->move('uploads/profile_img/', $fileName);

            $user->prof_pic = $fileName;

        }
    

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        if (Auth::user()->role == 'Admin'){
            return redirect('admin/fieldStaff/list')->with('success', 'Field Staff User Updated Succesfully');
        }
        elseif (Auth::user()->role == 'Manager'){
            return redirect('manager/fieldStaff/list')->with('success', 'Field Staff User Updated Succesfully');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::getRecByID($id);
        $user->delete();

        if (Auth::user()->role == 'Admin'){
            return redirect('admin/fieldStaff/list')->with('success', 'Field Staff User Deleted Succesfully');
        }
        elseif (Auth::user()->role == 'Manager'){
            return redirect('manager/fieldStaff/list')->with('success', 'Field Staff User Deleted Succesfully');
        }

        
    }
}
