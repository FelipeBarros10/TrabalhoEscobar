<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleModel;

class DashboardController extends Controller
{
    /**
     * Admin home with quick metrics.
     */
    public function index()
    {
        $metrics = [
            'vehicle_count' => Vehicle::count(),
            'brand_count' => Brand::count(),
            'model_count' => VehicleModel::count(),
        ];

        $latestVehicles = Vehicle::with(['brand', 'model'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('metrics', 'latestVehicles'));
    }
}
