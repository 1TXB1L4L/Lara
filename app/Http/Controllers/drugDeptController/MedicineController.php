<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Generic;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::with('generic')->get();
        return view('drugDept.medicine.index', [
            'medicines' => $medicines,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generics = Generic::all();
        return view('drugDept.medicine.create', compact('generics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'med_name' => 'required|string|max:255',
            'med_description' => 'nullable',
            'generic_id' => 'required|integer',
            'med_quantity' => 'nullable|integer',
            'med_price' => 'nullable|integer',
            'med_batch_no' => 'nullable|string|max:255',
            'med_dosage' => 'nullable|string|max:255',
            'med_strength' => 'nullable|string|max:255',
            'med_route' => 'nullable|string|max:255',
            'med_therapeutic_class' => 'nullable|string|max:255',
            'med_notes' => 'nullable|string|max:255',
            'med_expiry_date' => 'date|nullable',
            'med_category' => 'nullable|string|max:255',
            'med_manufacturer' => 'nullable|string|max:255',
            'med_status' => 'nullable|boolean',
            'med_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $path = null;
        $filename = null;
        if ($request->hasFile('med_image')) {
            $file = $request->file('med_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/medicines/';
            $file->move($path, $filename);
        }

        Medicine::create([
            'med_name' => $request->med_name,
            'med_description' => $request->med_description,
            'generic_id' => $request->generic_id,
            'med_quantity' => $request->med_quantity,
            'med_price' => $request->med_price,
            'med_batch_no' => $request->med_batch_no,
            'med_dosage' => $request->med_dosage,
            'med_strength' => $request->med_strength,
            'med_route' => $request->med_route,
            'med_therapeutic_class' => $request->med_therapeutic_class,
            'med_notes' => $request->med_notes,
            'med_expiry_date' => $request->med_expiry_date,
            'med_category' => $request->med_category,
            'med_manufacturer' => $request->med_manufacturer,
            'med_status' => $request->has('med_status') ? 1 : 0,
            'med_image' => $path . $filename,
        ]);

        return redirect('/medicines')->with('status', 'Medicine created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        return view('drugDept.medicine.show', compact('medicine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        $generics = Generic::all()->pluck('generic_name', 'id')->orderBy('generic_name');
        return view('drugDept.medicine.edit', compact('medicine', 'generics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'med_name' => 'required|string|max:255',
            'med_description' => 'nullable',
            'generic_id' => 'required|integer',
            'med_quantity' => 'nullable|integer',
            'med_price' => 'nullable|integer',
            'med_batch_no' => 'nullable|string|max:255',
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

        // Use the existing image if no new image is uploaded

        $path = $medicine->med_image;
        $filename = null;

        if ($request->hasFile('med_image')) {
            $file = $request->file('med_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/medicines/';
            $file->move($path, $filename);
            // Optionally, delete the existing image file from storage
            if (File::exists(public_path($medicine->med_image))) {
                File::delete(public_path($medicine->med_image));
            }
        }

        $medicine->update([
            'med_name' => $request->med_name,
            'med_description' => $request->med_description,
            'generic_id' => $request->generic_id,
            'med_quantity' => $request->med_quantity,
            'med_price' => $request->med_price,
            'med_batch_no' => $request->med_batch_no,
            'med_dosage' => $request->med_dosage,
            'med_strength' => $request->med_strength,
            'med_route' => $request->med_route,
            'med_therapeutic_class' => $request->med_therapeutic_class,
            'med_notes' => $request->med_notes,
            'med_expiry_date' => $request->med_expiry_date,
            'med_category' => $request->med_category,
            'med_manufacturer' => $request->med_manufacturer,
            'med_status' => $request->has('med_status') ? 1 : 0,
            'med_image' => $path . $filename,
        ]);
        return redirect('/medicines')->with('status', 'Medicine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        // Optionally, delete the image file from storage
        if (File::exists(public_path($medicine->med_image))) {
            File::delete(public_path($medicine->med_image));
        }
        $medicine->delete();
        return redirect('/medicines')->with('status', 'Medicine deleted successfully.');
    }
}
