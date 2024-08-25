<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::all();
        return view('medicine.index', [
            'medicines' => $medicines,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medicine.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'med_name' => 'required|string|max:255',
            'med_description' => 'nullable',
            'med_generic_name' => 'required|string|max:255',
            'med_quantity' => 'nullable|integer',
            'med_price' => 'nullable|integer',
            'med_dosage' => 'nullable|string|max:255',
            'med_strength' => 'nullable|string|max:255',
            'med_route' => 'nullable|string|max:255',
            'med_therapeutic_class' => 'nullable|string|max:255',
            'med_notes' => 'nullable|string|max:255',
            'med_expiry_date' => 'nullable|date',
            'med_category' => 'nullable|string|max:255',
            'med_manufacturer' => 'nullable|string|max:255',
            'med_status' => 'nullable|boolean',
            'med_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('med_image')) {
            $image = $request->file('med_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/medicines');
            $image->move($destinationPath, $name);
        } 

        Medicine::create([
            'med_name' => $request->med_name,
            'med_description' => $request->med_description,
            'med_generic_name' => $request->med_generic_name,
            'med_quantity' => $request->med_quantity,
            'med_price' => $request->med_price,
            'med_dosage' => $request->med_dosage,
            'med_strength' => $request->med_strength,
            'med_route' => $request->med_route,
            'med_therapeutic_class' => $request->med_therapeutic_class,
            'med_notes' => $request->med_notes,
            'med_expiry_date' => $request->med_expiry_date,
            'med_category' => $request->med_category,
            'med_manufacturer' => $request->med_manufacturer,
            'med_status' => $request->med_status == true ? 1 : 0,
            'med_image' => $name,
        ]);

        return redirect('/medicines')->with('status', 'Medicine created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return view('medicine.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return view('medicine.edit', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'med_name' => 'required|string|max:255',
            'med_description' => 'nullable',
            'med_generic_name' => 'required|string|max:255',
            'med_quantity' => 'nullable|integer',
            'med_price' => 'nullable|integer',
            'med_dosage' => 'nullable|string|max:255',
            'med_strength' => 'nullable|string|max:255',
            'med_route' => 'nullable|string|max:255',
            'med_therapeutic_class' => 'nullable|string|max:255',
            'med_notes' => 'nullable|string|max:255',
            'med_expiry_date' => 'required|date',
            'med_category' => 'nullable|string|max:255',
            'med_manufacturer' => 'nullable|string|max:255',
            'med_status' => 'nullable|boolean',
            'med_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('med_image')) {
            $image = $request->file('med_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/medicines');
            $image->move($destinationPath, $name);
        } else {
            $name = null;
        };


        $destinationPath = public_path('/images/medicines');

        $medicine->update([
            'med_name' => $request->med_name,
            'med_description' => $request->med_description,
            'med_generic_name' => $request->med_generic_name,
            'med_quantity' => $request->med_quantity,
            'med_price' => $request->med_price,
            'med_dosage' => $request->med_dosage,
            'med_strength' => $request->med_strength,
            'med_route' => $request->med_route,
            'med_therapeutic_class' => $request->med_therapeutic_class,
            'med_notes' => $request->med_notes,
            'med_expiry_date' => $request->med_expiry_date,
            'med_category' => $request->med_category,
            'med_manufacturer' => $request->med_manufacturer,
            'med_status' => $request->med_status == true ? 1 : 0,
            'med_image' => $destinationPath . '/' . $name,
        ]);

        return redirect('/medicines')->with('status', 'Medicine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect('/medicines')->with('status', 'Medicine deleted successfully.');
    }
}
