<?php

namespace App\Http\Controllers;

use App\Models\AnimalModel;
use Illuminate\Http\Request;
use App\Models\VaccinationModel;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexDueRec()
    {
        $data['fetchedRecord'] = VaccinationModel::getDueRec();

        $data['headerTitle'] = 'Vaccine List';

        return view('animal.animalHealth.vaccination.due_list', $data);
    }

    
    public function indexFull()
    {
        $data['fetchedRecord'] = VaccinationModel::getAllVaccinationRec();

        // $data['fetchedRecord'] = VaccinationModel::all();

        $data['headerTitle'] = 'Vaccine List';

        return view('animal.animalHealth.vaccination.full_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['headerTitle'] = 'Add New Vaccine Record';
        return view('animal.animalHealth.vaccination.add_new_vacc', $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    
    //Store animal IDs to the temp. table
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
            
            if ($fetchAnimalRec->status == 'Active') {
            
                $data['fetchedRecord'] = $fetchAnimalRec->animal_id;
    
                $data['headerTitle'] = 'Add New Vaccine Record';
    
                return view('animal.animalHealth.vaccination.add_new_vacc', $data);
    
            }
            else {
    
                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/vaccin_monitor/add')->with('error', 'Selected Animal not in Active Status');
                }
                else {
                    return redirect('medicalStaff/ani_health/vaccin_monitor/add')->with('error', 'Selected Animal not in Active Status');
                }
                
            }

        }
        else {
            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/vaccin_monitor/add')->with('error', 'Selected Animal ID is Invalid');
            }
            else {
                return redirect('medicalStaff/ani_health/vaccin_monitor/add')->with('error', 'Selected Animal ID is Invalid');
            }

        }

    }




    public function store(Request $request)
    {   

        $request->validate([

            'animal_id' => 'required',
            'vac_date' => 'required|date',
            'vac_name' => 'required|string',
            'next_vac_name' => 'nullable|string',
            'next_vac_date' => 'nullable|date',

        ]);

        $vacDate = $request->vac_date;
        $nextVacName = $request->next_vac_name;
        $nextVacDate = $request->next_vac_date;

        if ((!empty($nextVacName) && empty($nextVacDate)) || (empty($nextVacName) && !empty($nextVacDate))) {
            
            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/vaccin_monitor/add')->with('error', 'Please fill both Next Vaccine Name & Date If any next Vaccine');
            }
            else {
                return redirect('medicalStaff/ani_health/vaccin_monitor/add')->with('error', 'Please fill both Next Vaccine Name & Date If any next Vaccine');
            }

        }
        elseif (!empty($nextVacDate) && ($vacDate >= $nextVacDate)){

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/vaccin_monitor/add')->with('error', 'Next Vaccination date cannot be a older date then current date');
            }
            else {
                return redirect('medicalStaff/ani_health/vaccin_monitor/add')->with('error', 'Next Vaccination date cannot be a older date then current date');
            }

        }

        else {

            if (empty($nextVacName) && empty($nextVacDate)) {

                $vaccine = new VaccinationModel();

                $vaccine->animal_id = trim($request->animal_id);
                $vaccine->vac_name = trim($request->vac_name);
                $vaccine->vac_date = $request->vac_date;
                $vaccine->vac_by =  Auth::user()->emp_id;
                $vaccine->status = 'Completed';

                $vaccine->save();

                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }
                else {
                    return redirect('medicalStaff/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }

            }
            else {

                $vaccine = new VaccinationModel();

                $vaccine->animal_id = trim($request->animal_id);
                $vaccine->vac_name = trim($request->vac_name);
                $vaccine->vac_date = $request->vac_date;
                $vaccine->vac_by =  Auth::user()->emp_id;
                $vaccine->next_vac_name = trim($request->next_vac_name);
                $vaccine->next_vac_date = $request->next_vac_date;
                $vaccine->status = 'Incomplete';

                $vaccine->save();

                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }
                else {
                    return redirect('medicalStaff/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }

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
        $data['fetchedRecord'] = VaccinationModel::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Vaccination Info.';
            return view('animal.animalHealth.vaccination.edit_vacc', $data);

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
            'vac_date' => 'required|date',
            'vac_name' => 'required|string',
            'next_vac_name' => 'nullable|string',
            'next_vac_date' => 'nullable|date',

        ]);

        
        $vacDate = $request->vac_date;
        $nextVacName = $request->next_vac_name;
        $nextVacDate = $request->next_vac_date;

        if ((!empty($nextVacName) && empty($nextVacDate)) || (empty($nextVacName) && !empty($nextVacDate))) {
            
            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/vaccin_monitor/'.$id.'/edit')->with('error', 'Please fill both Next Vaccine Name & Date If any next Vaccine');
            }
            else {
                return redirect('medicalStaff/ani_health/vaccin_monitor/'.$id.'/edit')->with('error', 'Please fill both Next Vaccine Name & Date If any next Vaccine');
            }

        }
        elseif (!empty($nextVacDate) && ($vacDate >= $nextVacDate)){

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/vaccin_monitor/'.$id.'/edit')->with('error', 'Next Vaccination date cannot be a older date then current date');
            }
            else {
                return redirect('medicalStaff/ani_health/vaccin_monitor/'.$id.'/edit')->with('error', 'Next Vaccination date cannot be a older date then current date');
            }

        }

        else {

            if (empty($nextVacName) && empty($nextVacDate)) {

                $vaccineOld = VaccinationModel::getRecByID($id);
                $vaccineOld->status = 'Completed';

                $vaccineOld->save();

                $vaccine = new VaccinationModel();

                $vaccine->animal_id = trim($request->animal_id);
                $vaccine->vac_name = trim($request->vac_name);
                $vaccine->vac_date = $request->vac_date;
                $vaccine->vac_by =  Auth::user()->emp_id;
                $vaccine->status = 'Completed';

                $vaccine->save();

                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }
                else {
                    return redirect('medicalStaff/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }

            }
            else {

                $vaccineOld = VaccinationModel::getRecByID($id);
                $vaccineOld->status = 'Completed';

                $vaccineOld->save();
                

                $vaccine = new VaccinationModel();

                $vaccine->animal_id = trim($request->animal_id);
                $vaccine->vac_name = trim($request->vac_name);
                $vaccine->vac_date = $request->vac_date;
                $vaccine->vac_by =  Auth::user()->emp_id;
                $vaccine->next_vac_name = trim($request->next_vac_name);
                $vaccine->next_vac_date = $request->next_vac_date;
                $vaccine->status = 'Incomplete';

                $vaccine->save();

                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }
                else {
                    return redirect('medicalStaff/ani_health/vaccin_monitor')->with('success', 'Vaccine Recorded Succesfully');
                }

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
