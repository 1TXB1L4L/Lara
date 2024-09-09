<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Http\Resources\MedicineResource;

class MedicineController extends Controller
{
    /**
     * Display a listing of the medicines.
     */
    public function index(Request $request)
    {
        $query = Medicine::query();

        if ($request->has('q')) {
            $search = $request->input('q');
            $query->where('name', 'like', "%{$search}%")
                ->orWhereHas('generic', function ($query) use ($search) {
                    $query->where('generic_name', 'like', "%{$search}%");
                });
        }

        $medicines = $query->get();

        return MedicineResource::collection($medicines);
    }
}
