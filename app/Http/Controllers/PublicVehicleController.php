<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class PublicVehicleController extends Controller
{
    /**
     * Display the specified vehicle in detail.
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->load(['brand', 'model', 'color', 'photos']);

        return view('vehicles.show', compact('vehicle'));
    }
}

