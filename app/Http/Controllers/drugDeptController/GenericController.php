<?php

namespace App\Http\Controllers\drugDeptController;

use App\Http\Controllers\Controller;
use App\Models\Generic;
use Illuminate\Http\Request;

class GenericController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generics = Generic::all();
        return view('drugDept.generic.index')->with('generics', $generics);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('drugDept.generic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'generic_name' => 'required',
            'generic_description' => 'nullable',
            'therapeutic_class' => 'nullable',
            'generic_category' => 'nullable',
            'generic_subcategory' => 'nullable',
            'generic_notes' => 'nullable',
            'generic_status' => 'nullable',
        ]);

        Generic::create([
            'generic_name' => $request->generic_name,
            'generic_description' => $request->generic_description,
            'therapeutic_class' => $request->generic_therapeutic_class,
            'generic_category' => $request->generic_category,
            'generic_subcategory' => $request->generic_subcategory,
            'generic_notes' => $request->generic_note,
            'generic_status' => $request->generic_status == true ? 1 : 0,
        ]);

        return redirect('/generics')->with('status', 'Generic created successfully.');
    }

    /**_
     * Display the specified resource.
     */
    public function show(Generic $generic)
    {
        return view('drugDept.generic.show', compact('generic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Generic $generic)
    {
        return view('drugDept.generic.edit', compact('generic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Generic $generic)
    {
        $request->validate([
            'generic_name' => 'required',
            'generic_description' => 'nullable',
            'therapeutic_class' => 'nullable',
            'generic_category' => 'nullable',
            'generic_subcategory' => 'nullable',
            'generic_notes' => 'nullable',
            'generic_status' => 'nullable',
        ]);
        //therapeutic_class
        $generic->update([
            'generic_name' => $request->generic_name,
            'generic_description' => $request->generic_description,
            'therapeutic_class' => $request->generic_therapeutic_class,
            'generic_category' => $request->generic_category,
            'generic_subcategory' => $request->generic_subcategory,
            'generic_notes' => $request->generic_note,
            'generic_status' => $request->generic_status == true ? 1 : 0,
        ]);

        return redirect('/generics')->with('status', 'Generic updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Generic $generic)
    {
        $generic->delete();
        return redirect('/generics')->with('status', 'Generic deleted successfully.');
    }
}
