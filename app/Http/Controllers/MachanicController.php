<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Machanic;
use Illuminate\Http\Request;

class MachanicController extends Controller
{
    public function index()
    {
        // Eager load cars and owners through cars
        $mechanics = Machanic::with(['carOwner'])->get();

        // Return JSON response instead of dd()
        return response()->json([
            'success' => true,
            'data' => $mechanics,
        ]);
    }
}
