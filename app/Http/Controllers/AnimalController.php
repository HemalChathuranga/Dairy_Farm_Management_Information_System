<?php

namespace App\Http\Controllers;

use App\Models\AnimalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['fetchedRecord'] = AnimalModel::getAnimalRec();
        $data['headerTitle'] = 'Animal List';
        return view('admin.animal.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['headerTitle'] = 'Add New Animal';
        return view('admin.animal.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'animal_id' => 'required|unique:animals',
            'birth_date' => 'required|date',
            'breed' => 'required|string',
            'gender' => 'required|string',
            'stall_number' => 'required|string',
            'weight_at_birth' => 'nullable|decimal',
            'height_at_birth' => 'nullable|decimal',
            'buy_price' => 'nullable|decimal',
            'buy_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'father_id' => 'nullable|string',
            'mother_id' => 'nullable|string',

        ]);


        $animal = new AnimalModel();

        $animal->animal_id = trim($request->animal_id);
        $animal->birth_date = $request->birth_date;
        $animal->breed = trim($request->breed);
        $animal->gender = $request->gender;
        $animal->stall_number = trim($request->stall_number);

        $weight_at_birth = 0.00;
        $height_at_birth = 0.00;
        $buy_price = 0.00;

        if (!empty($request->weight_at_birth)) {
           
            $weight_at_birth = trim($request->weight_at_birth);
        }

        if (!empty($request->height_at_birth)) {
           
            $height_at_birth = trim($request->height_at_birth);
        }

        if (!empty($request->buy_price)) {
           
            $buy_price = trim($request->buy_price);
        }

        $animal->weight_at_birth = $weight_at_birth;
        $animal->height_at_birth = $height_at_birth;
        $animal->buy_price = $buy_price;
        $animal->buy_date = $request->buy_date;
        $animal->notes = $request->notes;
        $animal->father_id = trim($request->father_id);
        $animal->mother_id = trim($request->mother_id);


        $animal->created_by = Auth::user()->emp_id;

        $animal->save();

        return redirect('admin/animal/list')->with('success', 'New Animal Created Succesfully');
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
        $data['fetchedRecord'] = AnimalModel::getRecByID($id);

        if (!empty($data['fetchedRecord'])) {
            
            $data['headerTitle'] = 'Edit Animal Info.';
            return view('admin.animal.edit', $data);

        } else {
            
            abort(404);
        }
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
