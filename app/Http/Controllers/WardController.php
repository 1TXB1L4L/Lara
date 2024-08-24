<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ward;

class WardController extends Controller
{
    public function index()
    {
        $wards = Ward::all();
        return view('ward.index')->with('wards', $wards);
    }

    public function create()
    {
        $wards = Ward::all();
        return view('ward.create')->with('wards', $wards);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ward_name' => 'required|string|max:150',
            'ward_description' => 'nullable|string',
            'ward_capacity' => 'nullable|numeric',
            'ward_status' => 'nullable|boolean',
        ]);

        Ward::create([
            'ward_name' => $request->ward_name,
            'ward_description' => $request->ward_description,
            'ward_capacity' => $request->ward_capacity,
            'ward_status' => $request->has('ward_status') ? 0 : 1, // Handle checkbox input
        ]);

        return redirect()->route('wards.index')->with('status', 'Ward created successfully');
    }

    public function edit($wId)
    {
        $ward = Ward::findOrFail($wId); // Use findOrFail for consistency
        return view('ward.edit')->with('ward', $ward);
    }

    public function update(Request $request, $wId)
    {
        $request->validate([
            'ward_name' => 'required|string',
            'ward_description' => 'nullable|string',
            'ward_capacity' => 'nullable|numeric',
            'ward_status' => 'required|boolean',
        ]);

        $ward = Ward::findOrFail($wId);
        $ward->ward_name = $request->ward_name;
        $ward->ward_description = $request->ward_description;
        $ward->ward_capacity = $request->ward_capacity;
        $ward->ward_status = $request->has('ward_status') ? 1 : 0; // Handle checkbox input
        $ward->save();

        return redirect()->route('wards.index')->with('status', 'Ward updated successfully');
    }

    public function destroy($wId)
    {
        $ward = Ward::findOrFail($wId);
        $ward->delete();
        return redirect()->route('wards.index')->with('status', 'Ward deleted successfully');
    }

    public function show($wId)
    {
        $ward = Ward::findOrFail($wId);
        return response()->json($ward);
    }
}
