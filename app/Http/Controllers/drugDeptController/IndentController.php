<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indent;
use App\Models\Medicine;
use DB;

class IndentController extends Controller
{
    /**
     * Display a listing of the resource, with optional search functionality.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Indent::query();

        if ($search) {
            $query->where('medicine_name', 'like', '%' . $search . '%')
                ->orWhere('generic_name', 'like', '%' . $search . '%')
                ->orWhere('indent_date', 'like', '%' . $search . '%')
                ->orWhere('indent_status', 'like', '%' . $search . '%');
        }

        $records = $query->orderBy('indent_date', 'desc')->paginate(25);
        return view('drugDept.indent.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('drugDept.indent.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage, with transaction handling.
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        DB::transaction(function () use ($request) {
            // Fetch the selected medicine to get the name and generic name
            $medicine = Medicine::findOrFail($request->medicine_id);

            // Creating the indent
            $indent = Indent::create([
                'medicine_id' => $request->medicine_id,
                'medicine_name' => $medicine->name, // Set the medicine name
                'generic_name' => $medicine->generic->generic_name, // Set the generic name
                'quantity' => $request->indent_quantity, // Updated to match the migration field
                'indent_date' => $request->indent_date,
                'indent_status' => $request->indent_status,
                'indent_remarks' => $request->indent_remarks,
                'user_id' => auth()->id(),
                'previous_quantity' => $medicine->quantity, // Storing previous quantity
                'batch_number' => $request->batch_number,
                'expiry_date' => $request->expiry_date,
            ]);

            // Updating the medicine quantity
            $medicine->quantity -= $request->indent_quantity; // Decrementing the quantity as it's being indented
            $medicine->save();
        });

        return redirect('/indents')->with('success', 'Indent created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Indent $indent)
    {
        return view('drugDept.indent.show', compact('indent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indent $indent)
    {
        $medicines = Medicine::orderBy('name')->get();
        return view('drugDept.indent.edit', compact('indent', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indent $indent)
    {
        $request->validate($this->validationRules());

        DB::transaction(function () use ($request, $indent) {
            // Fetch the selected medicine to get the name and generic name
            $medicine = Medicine::findOrFail($request->medicine_id);

            // Update the indent
            $indent->update([
                'medicine_id' => $request->medicine_id,
                'medicine_name' => $medicine->name, // Set the medicine name
                'generic_name' => $medicine->generic->generic_name, // Set the generic name
                'quantity' => $request->indent_quantity, // Updated to match the migration field
                'indent_date' => $request->indent_date,
                'indent_status' => $request->indent_status,
                'indent_remarks' => $request->indent_remarks,
                'batch_number' => $request->batch_number,
                'expiry_date' => $request->expiry_date,
            ]);

            // Adjust the medicine quantity based on the updated indent
            $medicine->quantity -= $request->indent_quantity; // Decrement quantity accordingly
            $medicine->save();
        });

        return redirect('/indents')->with('success', 'Indent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indent $indent)
    {
        $indent->delete();
        return redirect('/indents')->with('success', 'Indent deleted successfully.');
    }

    /**
     * Validation rules for creating or updating an indent.
     */
    private function validationRules()
    {
        return [
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|numeric|min:1', // Updated to match the migration field
            'indent_date' => 'required|date',
            'indent_status' => 'required|string',
            'indent_remarks' => 'nullable|string',
            'batch_number' => 'nullable|string',
            'expiry_date' => 'nullable|date',
        ];
    }
}
