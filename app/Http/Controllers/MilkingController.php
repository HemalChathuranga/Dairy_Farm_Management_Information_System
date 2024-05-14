<?php

namespace App\Http\Controllers;

use App\Mail\ChangeMilkVol;
use App\Models\AnimalModel;
use App\Models\MilkingModel;
use Illuminate\Http\Request;
use App\Models\MilkingTempModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MilkingController extends Controller
{

        /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['fetchedRecord'] = MilkingModel::getMilkingRecords();

        $data['headerTitle'] = 'Milking Info.';
        
        return view('milkParlor.list', $data);

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
        $request->validate([

            'cow.*' => 'required',
        ], [
            'cow.*' => 'Please Input Milk Volume for :attribute',
        ]);


        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');
        $timeStamp = date('A');

        //Store Milking details of the Morning Session
        if ($timeStamp == 'AM') {

            foreach($request->ani_id as $key=>$ani_id){
            
                $data = new MilkingModel();
    
                $data->milking_date = $todayDate;
                $data->animal_id = $ani_id;
                $data->Morning_vol = $request->cow[$key];
                $data->mor_added_by = Auth::user()->emp_id;
    
                $data->save();
    
            }

            MilkingTempModel::truncate();

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/add_milking_queue')->with('success', 'Milking Records added Successfully.');
            }
            else {
                return redirect('fieldStaff/milkParlor/add_milking_queue')->with('success', 'Milking Records added Successfully.');
            }

        }
        //Store Milking details of the Evening Session
        else {

            foreach($request->ani_id as $key=>$ani_id){

                //Fetching Milking details of the cow for current date to check whether the cow already Milked for the day
                $fetchTodayMilkingRec = MilkingModel::getTodayMilkingRec($ani_id, $todayDate);

                //Check If Animal is available in the milking table for today
                if (!empty($fetchTodayMilkingRec)) {

                    $data = $fetchTodayMilkingRec;

                    $data->evening_vol = $request->cow[$key];
                    $data->eve_added_by = Auth::user()->emp_id;
        
                    $data->save();
                }
                else {

                    $data = new MilkingModel();
        
                    $data->milking_date = $todayDate;
                    $data->animal_id = $ani_id;
                    $data->evening_vol = $request->cow[$key];
                    $data->eve_added_by = Auth::user()->emp_id;
        
                    $data->save();

                }

            }

            MilkingTempModel::truncate();
    
                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/milkParlor/add_milking_queue')->with('success', 'Milking Records added Successfully.');
                }
                else {
                    return redirect('fieldStaff/milkParlor/add_milking_queue')->with('success', 'Milking Records added Successfully.');
                }

        }

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
        $request->validate([

            'mor_milk_vol' => 'required',

        ]);

        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');

        $record = MilkingModel::getRecByID($id);

        //Assign current record for the comparison in the email
        $recordOld = MilkingModel::getRecByID($id);

        $oldMorVol = $record->morning_vol;
        $oldEveVol = $record->evening_vol;

        if (($oldMorVol != $request->mor_milk_vol) && ($oldEveVol != $request->eve_milk_vol)) {

            $record->morning_vol = $request->mor_milk_vol;
            $record->mor_updated_by = Auth::user()->emp_id;
            $record->mor_updated_date = $todayDate;

            $record->evening_vol = $request->eve_milk_vol;
            $record->eve_updated_by = Auth::user()->emp_id;
            $record->eve_updated_date = $todayDate;

            $record->save();


            // Email Functionality
            $editedBy = Auth::user()->first_name . ' ' . Auth::user()->last_name . ' (' . Auth::user()->emp_id . ')';
            $toEmail = 'dfmis.srilanka@gmail.com';
            $ccEmail = Auth::user()->email;
            $subject = 'Milking Details updated in DFMIS';

            Mail::to($toEmail)
                    ->cc($ccEmail)
                    ->send(new ChangeMilkVol($subject, $editedBy, $recordOld, $record));
            
            //****************************** */


            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            elseif (Auth::user()->role == 'Manager') {
                return redirect('manager/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            else {
                return redirect('fieldStaff/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            
        }
        elseif (($oldMorVol != $request->mor_milk_vol) && ($oldEveVol == $request->eve_milk_vol)) {

            $record->morning_vol = $request->mor_milk_vol;
            $record->mor_updated_by = Auth::user()->emp_id;
            $record->mor_updated_date = $todayDate;
            
            $record->save();

            // Email Functionality
            $editedBy = Auth::user()->first_name . ' ' . Auth::user()->last_name . ' (' . Auth::user()->emp_id . ')';
            $toEmail = 'dfmis.srilanka@gmail.com';
            $ccEmail = Auth::user()->email;
            $subject = 'Milking Details updated in DFMIS';

            Mail::to($toEmail)
                    ->cc($ccEmail)
                    ->send(new ChangeMilkVol($subject, $editedBy, $recordOld, $record));
            
            //****************************** */


            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            elseif (Auth::user()->role == 'Manager') {
                return redirect('manager/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            else {
                return redirect('fieldStaff/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }

        }
        elseif (($oldMorVol == $request->mor_milk_vol) && ($oldEveVol != $request->eve_milk_vol)) {

            $record->evening_vol = $request->eve_milk_vol;
            $record->eve_updated_by = Auth::user()->emp_id;
            $record->eve_updated_date = $todayDate;

            $record->save();

            // Email Functionality
            $editedBy = Auth::user()->first_name . ' ' . Auth::user()->last_name . ' (' . Auth::user()->emp_id . ')';
            $toEmail = 'dfmis.srilanka@gmail.com';
            $ccEmail = Auth::user()->email;
            $subject = 'Milking Details updated in DFMIS';

            Mail::to($toEmail)
                    ->cc($ccEmail)
                    ->send(new ChangeMilkVol($subject, $editedBy, $recordOld, $record));
            
            //****************************** */
            

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            elseif (Auth::user()->role == 'Manager') {
                return redirect('manager/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            else {
                return redirect('fieldStaff/milkParlor/milking_info')->with('success', 'Milking Info. Updated Succesfully');
            }
            
        }
        else {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/milking_info')->with('info', 'No any Changes to update');
            }
            elseif (Auth::user()->role == 'Manager') {
                return redirect('manager/milkParlor/milking_info')->with('info', 'No any Changes to update');
            }
            else {
                return redirect('fieldStaff/milkParlor/milking_info')->with('info', 'No any Changes to update');
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $record = MilkingModel::getRecByID($id);

        $record->delete();

        return redirect('admin/milkParlor/milking_info')->with('success', 'Milking Record has been Deleted');

    }
    


    //Milking Queue Page Temporary table
    public function indexTempRec(){

        $data['fromQR'] = '';

        $data['fetchedRecord'] = MilkingTempModel::all();

        $data['headerTitle'] = 'Milking Queue';
        
        if (Auth::user()->role == 'Admin') {
            return view('milkParlor.admin.add_milking_queue', $data);
        }
        else {
            return view('milkParlor.fieldStaff.add_milking_queue', $data);
        }
        
    }

    //Add Animal ID from the QR read
    public function addQRData(Request $request){

        $fromQR = trim($request->animal_id);

        if (Auth::user()->role == 'Admin') {
            return redirect('admin/milkParlor/add_milking_queue')->with('qrValue', $fromQR);
        }
        else {
            return redirect('fieldStaff/milkParlor/add_milking_queue')->with('qrValue', $fromQR);
        }

    }
    

    //Store animal IDs to the temp. table
    public function storeTempRec(Request $request)
    {
        $request->validate([

            'animal_id' => 'required|unique:milking_queue_temp',

        ], [

            'animal_id.required' => 'Please Input Animal ID Mannually or Scan QR',
            'animal_id.unique' => 'This Animal is already added to the Milking Queue',

        ]);


        //Fetching Animal details of the cow to be added to the queue to check the Milking status
        $fetchAnimalRec = AnimalModel::getRecByAniID($request->animal_id);


        //Fetching Milking details of the cow for current date to check whether the cow already Milked for the day
        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');
        $timeStamp = date('A');

        $fetchTodayMilkingRec = MilkingModel::getTodayMilkingRec($request->animal_id, $todayDate);

        //Check if the selected cow is fit for Milking
        if (($fetchAnimalRec->milking_status == 'Milking') && ($fetchAnimalRec->status == 'Active') && ($fetchAnimalRec->gender == 'Female')) {

            //Checkings for adding a cow to Morning queue
            if ($timeStamp == 'AM') {

                //Check If Animal is available in the milking table for today
                if (!empty($fetchTodayMilkingRec)) {

                    if (Auth::user()->role == 'Admin') {
                        return redirect('admin/milkParlor/add_milking_queue')->with('error', 'Selected Animal already Milked for Morning Session');
                    }
                    else {
                        return redirect('fieldStaff/milkParlor/add_milking_queue')->with('error', 'Selected Animal already Milked for Morning Session');
                    }
                    
                }
                else {

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
                
            }
            //Checkings for adding a cow to Evening queue
            else {

                //Check If Animal is available in the milking table for today
                if (!empty($fetchTodayMilkingRec)) {

                    if (($fetchTodayMilkingRec->evening_vol) > 0.00) {

                        if (Auth::user()->role == 'Admin') {
                            return redirect('admin/milkParlor/add_milking_queue')->with('error', 'Selected Animal already Milked for Evening Session');
                        }
                        else {
                            return redirect('fieldStaff/milkParlor/add_milking_queue')->with('error', 'Selected Animal already Milked for Evening Session');
                        }
                    }
                    else {
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

                }
                else {

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

            }

        }
        elseif ($fetchAnimalRec->status == 'Inactive'){

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/add_milking_queue')->with('error', 'Selected Animal not in Active Status');
            }
            else {
                return redirect('fieldStaff/milkParlor/add_milking_queue')->with('error', 'Selected Animal not in Active Status');
            }

        }
        elseif ($fetchAnimalRec->gender == 'Male'){

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/add_milking_queue')->with('error', 'Selected Animal not a Cow');
            }
            else {
                return redirect('fieldStaff/milkParlor/add_milking_queue')->with('error', 'Selected Animal not a Cow');
            }

        }
        else {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/milkParlor/add_milking_queue')->with('error', 'Selected Animal not Fit for Milking');
            }
            else {
                return redirect('fieldStaff/milkParlor/add_milking_queue')->with('error', 'Selected Animal not Fit for Milking');
            }

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
