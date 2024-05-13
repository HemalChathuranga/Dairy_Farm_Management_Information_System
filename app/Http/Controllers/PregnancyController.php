<?php

namespace App\Http\Controllers;

use App\Models\AnimalModel;
use Illuminate\Http\Request;
use App\Models\PregnancyModel;
use App\Models\VaccinationModel;
use Illuminate\Support\Facades\Auth;

class PregnancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexDueRec()
    {
        $data['fetchedRecord'] = PregnancyModel::getDueRec();

        $data['headerTitle'] = 'Pregnancy List';

        return view('animal.animalHealth.pregnancy.due_list', $data);
    }



    public function indexFull()
    {
        $data['fetchedRecord'] = PregnancyModel::getAllPregnancyRec();

        $data['headerTitle'] = 'Pregnancy Full List';

        return view('animal.animalHealth.pregnancy.full_list', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['headerTitle'] = 'Add New Pregnancy Record';
        return view('animal.animalHealth.pregnancy.add_new_preg', $data);
    }

    
    public function createTempRec(Request $request)
    {
        $request->validate([

            'animal_id' => 'required',

        ], [
            'animal_id.required' => 'Please Input Animal ID Mannually or Scan QR',
        ]);


        //Fetching Animal details of the cow to check the active status
        $fetchAnimalRec = AnimalModel::getRecByAniID($request->animal_id);

        if (!empty($fetchAnimalRec)) {
            
            if (($fetchAnimalRec->status == 'Active') && ($fetchAnimalRec->gender == 'Female')) {

                if ($fetchAnimalRec->pregnant_status == 'Yes') {
                    
                    if (Auth::user()->role == 'Admin') {
                        return redirect('admin/ani_health/preg_monitor/add')->with('error', 'Selected Animal is already in Pregnant Status');
                    }
                    else {
                        return redirect('medicalStaff/ani_health/preg_monitor/add')->with('error', 'Selected Animal is already in Pregnant Status');
                    }
    
                }
                else {
    
                    $data['fetchedRecord'] = $fetchAnimalRec->animal_id;
    
                    $data['headerTitle'] = 'Add New Pregnancy Record';
    
                    return view('animal.animalHealth.pregnancy.add_new_preg', $data);
    
                }    
    
            }
            elseif (($fetchAnimalRec->status == 'Active') && ($fetchAnimalRec->gender == 'Male')) {
                
                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/preg_monitor/add')->with('error', 'Selected Animal is not Female');
                }
                else {
                    return redirect('medicalStaff/ani_health/preg_monitor/add')->with('error', 'Selected Animal is not Female');
                }
    
            }
            else {
    
                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/preg_monitor/add')->with('error', 'Selected Animal not in Active Status');
                }
                else {
                    return redirect('medicalStaff/ani_health/preg_monitor/add')->with('error', 'Selected Animal not in Active Status');
                }
                
            }

        }
        else {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/preg_monitor/add')->with('error', 'Selected Animal ID is Invalid');
            }
            else {
                return redirect('medicalStaff/ani_health/preg_monitor/add')->with('error', 'Selected Animal ID is Invalid');
            }

        }
    
    }


    
    public function store(Request $request)
    {
        $request->validate([

            'animal_id' => 'required',
            'preg_date' => 'required|date',
            'estimated_delivery_date' => 'required|date',
        ]);


        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');

        $pregDate = $request->preg_date;
        $estDelvDate = $request->estimated_delivery_date;


        if ($pregDate > $todayDate) {
            
            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/preg_monitor/add')->with('error', 'Pragnancy Inspect date Cannot be a Future Date');
            }
            else {
                return redirect('medicalStaff/ani_health/preg_monitor/add')->with('error', 'Pragnancy Inspect date Cannot be a Future Date');
            }
            
        }
        elseif ($estDelvDate <= $todayDate){

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/preg_monitor/add')->with('error', 'Estimated Delivery date Cannot be a old Date');
            }
            else {
                return redirect('medicalStaff/ani_health/preg_monitor/add')->with('error', 'Estimated Delivery date Cannot be a old Date');
            }

        }
        else {

            //Fetching Animal details of the cow to change the pregnancy status and Occ
            $fetchAnimalRec = AnimalModel::getRecByAniID($request->animal_id);
            
            $newPregOcc = $fetchAnimalRec->pregnancy_occ + 1;

            $fetchAnimalRec->pregnant_status = "Yes";
            $fetchAnimalRec->pregnancy_occ = $newPregOcc;
            $fetchAnimalRec->milking_status = "Dry-Period";

            $fetchAnimalRec->save();

            //Creating new record for the pregnancy in pregnancy table
            $pregnancyRec = new PregnancyModel();

            $pregnancyRec->animal_id = trim($request->animal_id);
            $pregnancyRec->preg_date = $request->preg_date;
            $pregnancyRec->pregnancy_occ = $newPregOcc;
            $pregnancyRec->estimated_delivery_date = $request->estimated_delivery_date;
            $pregnancyRec->pregnancy_status = "Pregnant";
            $pregnancyRec->created_by = Auth::user()->emp_id;

            $pregnancyRec->save();


            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/preg_monitor')->with('success', 'Pregnancy Record has been created Successfully');
            }
            else {
                return redirect('medicalStaff/ani_health/preg_monitor')->with('success', 'Pregnancy Record has been created Successfully');
            }

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['fetchedRecord'] = PregnancyModel::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Animal Info.';
            return view('animal.animalHealth.pregnancy.view_preg', $data);

        } else {
            
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['fetchedRecord'] = PregnancyModel::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Pregnancy Info.';
            return view('animal.animalHealth.pregnancy.edit_preg', $data);

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

            'animal_id' => 'required',
            'preg_date' => 'required|date',
            'estimated_delivery_date' => 'required|date',
            'actual_delivery_date' => 'required|date',
        ]);


        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');
        $actDelDate = $request->actual_delivery_date;

        if ($actDelDate <= $todayDate) {
            
            //Fetching Animal details of the cow to change the pregnancy status
            $fetchAnimalRec = AnimalModel::getRecByAniID($request->animal_id);

            $fetchAnimalRec->pregnant_status = "No";
            $fetchAnimalRec->milking_status = "Milking";

            $fetchAnimalRec->save();


            //Update Rec in pregnancy table
            $pregnancyRec = PregnancyModel::getRecByID($id);

            $pregnancyRec->actual_delivery_date = $request->actual_delivery_date;
            $pregnancyRec->pregnancy_status = "Delivered";
            $pregnancyRec->updated_by = Auth::user()->emp_id;

            $pregnancyRec->save();


            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/preg_monitor')->with('success', 'Delivery details has been updated Successfully');
            }
            else {
                return redirect('medicalStaff/ani_health/preg_monitor')->with('success', 'Delivery details has been updated Successfully');
            }

        }
        else {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/preg_monitor/'.$id.'/edit')->with('error', 'Actual Delivery date Cannot be a Future Date');
            }
            else {
                return redirect('medicalStaff/ani_health/preg_monitor/'.$id.'/edit')->with('error', 'Actual Delivery date Cannot be a Future Date');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
