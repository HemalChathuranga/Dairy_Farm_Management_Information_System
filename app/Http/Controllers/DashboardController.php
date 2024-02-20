<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['headerTitle'] = 'Dashboard';

        if(Auth::user()->role == 'Admin'){
            return view('admin.dashboard', $data);
        }
        elseif(Auth::user()->role == 'Manager'){
            return view('manager.dashboard', $data);
        }
        elseif(Auth::user()->role == 'Office Staff'){
            return view('officeStaff.dashboard', $data);
        }
        elseif(Auth::user()->role == 'Medical Staff'){
            return view('medicalStaff.dashboard', $data);
        }
        elseif(Auth::user()->role == 'Field Staff'){
            return view('fieldStaff.dashboard', $data);
        }
        elseif(Auth::user()->role == 'Stores Staff'){
            return view('storesStaff.dashboard', $data);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
