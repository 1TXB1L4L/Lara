<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Ward;
use App\Models\Medicine;
use App\Models\Generic;
use App\Models\ExpenseRecord;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Expense::orderByDesc('date')->paginate(12);
        $expenseRecords = ExpenseRecord::all();
        return view('drugDept.expense.index', compact('records', 'expenseRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $wards = Ward::orderBy('ward_name', 'asc')->where('ward_status', 1)->get();
        return view('drugDept.expense.create', compact('wards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'ward_id' => 'required|exists:wards,id',
            'note' => 'nullable|string',
        ]);

        try {
            $expense = Expense::create([
                'date' => $request->date,
                'ward_id' => $request->ward_id,
                'note' => $request->note,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()->route('expenseRecord.create', ['expense_id' => $expense->id])
                ->with('success', 'Expense created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::findOrFail($id);
        $expenseRecords = ExpenseRecord::where('expense_id', $id)->get();

        return view('drugDept.expense.showRecord', compact('expense', 'expenseRecords'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        $wards = Ward::orderBy('ward_name', 'asc')->where('ward_status', 1)->get();
        return view('drugDept.expense.edit', compact('expense', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'date' => 'required',
            'ward_id' => 'required|exists:wards,id',
            'note' => 'nullable|string',
        ]);

        try {
            $expense = Expense::findOrFail($id);
            $expense->update([
                'date' => $request->date,
                'ward_id' => $request->ward_id,
                'note' => $request->note,
            ]);

            return redirect()->route('expense.index')->with('success', 'Expense updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();

            return redirect()->route('expense.index')->with('info', 'Expense deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
