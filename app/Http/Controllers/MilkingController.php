<?php

namespace App\Http\Controllers;

use App\Models\AnimalModel;
use Illuminate\Http\Request;
use App\Models\MilkingTempModel;
use Illuminate\Support\Facades\Auth;

class MilkingController extends Controller
{

        /**
     * Display a listing of the resource.
     */
    public function index()
    {

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

    }
    


    //Milking Queue Page Temporary table
    public function indexTempRec(){

        $data['fromQR'] = '';

        $data['fetchedRecord'] = MilkingTempModel::all();

        $data['headerTitle'] = 'Milking Queue';
        return view('milkParlor.add_milking_queue', $data);
    }

    //Add Animal ID from the QR read
    public function addQRData(Request $request){

        $fromQR = trim($request->animal_id);

        // $data['fetchedRecord'] = MilkingTempModel::all();

        // $data['headerTitle'] = 'Milking Queue';
        // return view('milkParlor.add_milking_queue', $data);

        return redirect('admin/milkParlor/add_milking_queue')->with('qrValue', $fromQR);

    }
    

    //Store animla IDs to the temp. table
    public function storeTempRec(Request $request)
    {
        $request->validate([

            'animal_id' => 'required|unique:milking_queue_temp',

        ], [

            'animal_id.required' => 'Please Input Animal ID Mannually or Scan QR',
            'animal_id.unique' => 'This Animal is already added to the Milking Queue',

        ]);


        $fetchMainTblRec = AnimalModel::getRecByAniID($request->animal_id);

        if ($fetchMainTblRec->milking_status == 'Milking') {
            $animal = new MilkingTempModel();

        $animal->animal_id = trim($request->animal_id);

        $animal->save();

        if (Auth::user()->role == 'Admin') {
            return redirect('admin/milkParlor/add_milking_queue')->with('success', 'Animal Added to the Queue Succesfully');
        }
        else {
            return redirect('fieldStaff/milkParlor/add_milking_queue')->with('success', 'Animal Added to the Queue Succesfully');
        }
            
        }
        else {
            return redirect('admin/milkParlor/add_milking_queue')->with('error', 'Selected Animal not Fit for Milking');
        }

        
    }


      
    //Remove record from Temp. Table
    public function destroyTempRec(string $id)
    {
        $animal = MilkingTempModel::getRecByID($id);

        $animal->delete();

        if (Auth::user()->role == 'Admin') {
            return redirect('admin/milkParlor/add_milking_queue')->with('success', 'Animal Removed from Queue Succesfully');
        }
        else {
            return redirect('fieldStaff/milkParlor/add_milking_queue')->with('success', 'Animal Removed from Queue Succesfully');
        }
    }


    //Remove all the records from Temp. Table
    public function destroyAllTempRec(){

        MilkingTempModel::truncate();


        if (Auth::user()->role == 'Admin') {
            return redirect('admin/milkParlor/add_milking_queue');
        }
        else {
            return redirect('fieldStaff/milkParlor/add_milking_queue');
        }

    }
}
