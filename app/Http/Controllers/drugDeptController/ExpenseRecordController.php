<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseRecord;
use App\Models\Medicine;
use App\Models\Generic;

class ExpenseRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // get status and id of the expense record
    public function create(Request $request)
    {
        $status = request('status');
        $expense_id = request('expense_id');
        $medicines = Medicine::all()->where('status', '1')->where('quantity', '>', '0')->sortBy('name');
        $generic = Generic::all();
        return view('drugDept.expense.createRecord', [
            'status' => $status,
            'expense_id' => $expense_id,
            'medicines' => $medicines,
            'generic' => $generic
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_id' => 'required|exists:expenses,id',
            'medicine_id.*' => 'required|exists:medicines,id',
            'medicine_name.*' => 'required|string',
            'generic_name.*' => 'required|string',
            'quantity.*' => 'required|integer|min:1',
        ]);

        try {
            foreach ($request->medicine_id as $index => $medicine_id) {
                ExpenseRecord::create([
                    'expense_id' => $request->expense_id,
                    'medicine_id' => $medicine_id,
                    'medicine_name' => $request->medicine_name[$index],
                    'generic_name' => $request->generic_name[$index],
                    'quantity' => $request->quantity[$index],
                ]);
            }

            return redirect()->route('expense.index')->with('status', 'Expense records created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
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
