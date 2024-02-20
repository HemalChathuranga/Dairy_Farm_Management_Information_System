<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['fetchedRecord'] = User::getAdminRec();
        $data['headerTitle'] = 'Admin List';
        return view('admin.admin.list', $data);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['headerTitle'] = 'Add New Admin';
        return view('admin.admin.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = new User();

        $user->emp_id = trim($request->emp_id);
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->gender = $request->gender;
        $user->role = 'Admin';
        $user->status = $request->status;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect('admin/admin/list')->with('success', 'Admin User Created Succesfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['fetchedRecord'] = User::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Admin User Info.';
            return view('admin.admin.view', $data);

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
            
            $data['headerTitle'] = 'Edit Admin User Info.';
            return view('admin.admin.edit', $data);

        } else {
            
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::getRecByID($id);

        $user->emp_id = trim($request->emp_id);
        $user->first_name = trim($request->first_name);
        $user->last_name = trim($request->last_name);
        $user->gender = $request->gender;
        $user->status = $request->status;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect('admin/admin/list')->with('success', 'Admin User Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::getRecByID($id);
        $user->delete();

        return redirect('admin/admin/list')->with('success', 'Admin User Deleted Succesfully');
    }
}
