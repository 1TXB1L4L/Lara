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
        $medicines = Medicine::orderBy('medicine_name')->get();
        return view('drugDept.indent.create', compact('medicines'));
    }

    /**
     * Store a newly created resource in storage, with transaction handling.
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        DB::transaction(function () use ($request) {
            // Creating the indent
            Indent::create([
                'medicine_id' => $request->medicine_id,
                'medicine_name' => $request->medicine_name,
                'generic_name' => $request->generic_name,
                'quantity' => $request->quantity,
                'indent_quantity' => $request->indent_quantity,
                'indent_amount' => $request->indent_amount,
                'indent_date' => $request->indent_date,
                'indent_status' => $request->indent_status,
                'indent_remarks' => $request->indent_remarks,
                'previous_quantity' => $request->previous_quantity,
            ]);

            // Updating the medicine quantity
            $medicine = Medicine::find($request->medicine_id);
            if ($medicine) {
                $medicine->quantity += $request->indent_quantity;
                $medicine->save();
            } else {
                throw new \Exception('Medicine not found.');
            }
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
        $medicines = Medicine::orderBy('medicine_name')->get();
        return view('drugDept.indent.edit', compact('indent', 'medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indent $indent)
    {
        $request->validate($this->validationRules());

        $indent->update([
            'medicine_id' => $request->medicine_id,
            'medicine_name' => $request->medicine_name,
            'generic_name' => $request->generic_name,
            'quantity' => $request->quantity,
            'indent_quantity' => $request->indent_quantity,
            'indent_amount' => $request->indent_amount,
            'indent_date' => $request->indent_date,
            'indent_status' => $request->indent_status,
            'indent_remarks' => $request->indent_remarks,
            'previous_quantity' => $request->previous_quantity,
        ]);

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
            'medicine_id' => 'required',
            'medicine_name' => 'required',
            'generic_name' => 'required',
            'quantity' => 'required|numeric',
            'indent_quantity' => 'required|numeric',
            'indent_amount' => 'required|numeric',
            'indent_date' => 'required',
            'indent_status' => 'required',
            'indent_remarks' => 'required',
            'previous_quantity' => 'required|numeric',
        ];
    }
}
