<?php

namespace App\Http\Controllers;

use App\Models\AnimalModel;
use Illuminate\Http\Request;
use App\Models\TreatmentModel;
use Illuminate\Support\Facades\Auth;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexPendingRec()
    {
        $data['fetchedRecord'] = TreatmentModel::getPendRec();

        $data['headerTitle'] = 'Treatment Pending List';

        return view('animal.animalHealth.treatment.due_list', $data);
    }


    public function indexFull()
    {
        $data['fetchedRecord'] = TreatmentModel::getAllTreatmentRec();

        $data['headerTitle'] = 'Treatment Full List';

        return view('animal.animalHealth.treatment.full_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['headerTitle'] = 'Add New Treatment Record';
        return view('animal.animalHealth.treatment.add_new_treat', $data);
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

            if (($fetchAnimalRec->status == 'Active')){

                $data['fetchedRecord'] = $fetchAnimalRec->animal_id;
    
                $data['headerTitle'] = 'Add New Treatment';

                return view('animal.animalHealth.treatment.add_new_treat', $data);

            }
            else {
    
                if (Auth::user()->role == 'Admin') {
                    return redirect('admin/ani_health/treatment/add')->with('error', 'Selected Animal not in Active Status');
                }
                else {
                    return redirect('medicalStaff/ani_health/treatment/add')->with('error', 'Selected Animal not in Active Status');
                }
                
            }

        }
        else {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/treatment/add')->with('error', 'Selected Animal ID is Invalid');
            }
            else {
                return redirect('medicalStaff/ani_health/treatment/add')->with('error', 'Selected Animal ID is Invalid');
            }

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'animal_id' => 'required',
            'inspect_date' => 'required|date',
            'milking_status' => 'required',
            'illness' => 'required',
        ]);


        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');

        $inspecDate = $request->inspect_date;

        if ($inspecDate > $todayDate) {
            
            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/treatment/add')->with('error', 'Inspect date Cannot be a Future Date');
            }
            else {
                return redirect('medicalStaff/ani_health/treatment/add')->with('error', 'Inspect date Cannot be a Future Date');
            }

        }
        else {

            //Fetching Animal details of the cow to change the pregnancy status and Occ
            $fetchAnimalRec = AnimalModel::getRecByAniID($request->animal_id);
            
            $fetchAnimalRec->milking_status = $request->milking_status;

            $fetchAnimalRec->save();


            //Creating new record for the pregnancy in pregnancy table
            $treatmentRec = new TreatmentModel();

            $treatmentRec->animal_id = trim($request->animal_id);

            $treatmentRec->inspect_date = $request->inspect_date;
            $treatmentRec->milking_status = $request->milking_status;
            $treatmentRec->illness = $request->illness;
            $treatmentRec->inspect_by = Auth::user()->emp_id;

            $treatmentRec->save();


            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/treatment')->with('success', 'Treatment Record has been created Successfully');
            }
            else {
                return redirect('medicalStaff/ani_health/treatment')->with('success', 'Treatment Record has been created Successfully');
            }

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['fetchedRecord'] = TreatmentModel::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Treatment Info.';
            return view('animal.animalHealth.treatment.view_treat', $data);

        } else {
            
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['fetchedRecord'] = TreatmentModel::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Treatment Info.';
            return view('animal.animalHealth.treatment.edit_treat', $data);

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
            'inspect_date' => 'required|date',
            'illness' => 'required',
            'treatment' => 'required',
            'milking_status' => 'required',
            'treat_date' => 'required|date',
            'treatment_status' => 'required',
        ]);


        date_default_timezone_set('Asia/Colombo');
        $todayDate = date('Y-m-d');
        $treatDate = $request->treat_date;
        $inspectDate = $request->inspect_date;

        if (($treatDate <= $todayDate) && ($treatDate >= $inspectDate)) {
            
            //Fetching Animal details of the cow to change the pregnancy status
            $fetchAnimalRec = AnimalModel::getRecByAniID($request->animal_id);

            $fetchAnimalRec->milking_status = $request->milking_status;

            $fetchAnimalRec->save();


            //Update Rec in pregnancy table
            $treatmentRec = TreatmentModel::getRecByID($id);

            $treatmentRec->treatment = $request->treatment;
            $treatmentRec->milking_status = $request->milking_status;
            $treatmentRec->treat_date = $request->treat_date;
            $treatmentRec->treatment_status = $request->treatment_status;
            $treatmentRec->treat_by = Auth::user()->emp_id;

            $treatmentRec->save();


            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/treatment')->with('success', 'Treatment details has been updated Successfully');
            }
            else {
                return redirect('medicalStaff/ani_health/treatment')->with('success', 'Treatment details has been updated Successfully');
            }

        }
        elseif ($treatDate < $inspectDate) {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/treatment/'.$id.'/edit')->with('error', 'Treatment Date cannot be an older date than Inspect Date');
            }
            else {
                return redirect('medicalStaff/ani_health/treatment/'.$id.'/edit')->with('error', 'Treatment Date cannot be an older date than Inspect Date');
            }

        }
        else {

            if (Auth::user()->role == 'Admin') {
                return redirect('admin/ani_health/treatment/'.$id.'/edit')->with('error', 'Treatment date Cannot be a Future Date');
            }
            else {
                return redirect('medicalStaff/ani_health/treatment/'.$id.'/edit')->with('error', 'Treatment date Cannot be a Future Date');
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
