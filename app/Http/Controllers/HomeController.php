<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * Display the public catalog of vehicles.
     */
    public function index()
    {
        $vehicles = Vehicle::with(['brand', 'model', 'color', 'photos'])
            ->orderByDesc('created_at')
            ->paginate(9);

        return view('home.index', compact('vehicles'));
    }
}

