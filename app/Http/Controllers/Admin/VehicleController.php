<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehiclePhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::with(['brand', 'model', 'color'])
            ->withCount('photos')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create(): View
    {
        $brands = Brand::orderBy('name')->get();
        $models = VehicleModel::with('brand')->orderBy('name')->get();
        $colors = Color::orderBy('name')->get();

        return view('admin.vehicles.create', compact('brands', 'models', 'colors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateVehicle($request);

        $vehicle = Vehicle::create([
            'brand_id' => $data['brand_id'],
            'vehicle_model_id' => $data['vehicle_model_id'],
            'color_id' => $data['color_id'],
            'year' => $data['year'],
            'mileage' => $data['mileage'],
            'price' => $data['price'],
            'description' => $data['description'],
            'main_image_url' => $data['main_image_url'],
            'created_by' => Auth::id(),
        ]);

        $this->syncPhotos($vehicle, $data['photo_urls'], $data['main_image_url']);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('status', 'Veículo cadastrado com sucesso.');
    }

    public function edit(Vehicle $vehicle): View
    {
        $vehicle->load('photos');

        $brands = Brand::orderBy('name')->get();
        $models = VehicleModel::with('brand')->orderBy('name')->get();
        $colors = Color::orderBy('name')->get();

        $additionalPhotos = $vehicle->photos()
            ->where('is_primary', false)
            ->pluck('url')
            ->toArray();

        return view('admin.vehicles.edit', compact('vehicle', 'brands', 'models', 'colors', 'additionalPhotos'));
    }

    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $data = $this->validateVehicle($request, $vehicle->id);

        $vehicle->update([
            'brand_id' => $data['brand_id'],
            'vehicle_model_id' => $data['vehicle_model_id'],
            'color_id' => $data['color_id'],
            'year' => $data['year'],
            'mileage' => $data['mileage'],
            'price' => $data['price'],
            'description' => $data['description'],
            'main_image_url' => $data['main_image_url'],
        ]);

        $this->syncPhotos($vehicle, $data['photo_urls'], $data['main_image_url']);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('status', 'Veículo atualizado com sucesso.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('status', 'Veículo removido.');
    }

    /**
     * Validate the incoming vehicle request.
     */
    protected function validateVehicle(Request $request, ?int $vehicleId = null): array
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'vehicle_model_id' => ['required', 'exists:vehicle_models,id'],
            'color_id' => ['required', 'exists:colors,id'],
            'year' => ['required', 'integer', 'between:1980,' . now()->addYear()->year],
            'mileage' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'string'],
            'main_image_url' => ['required', 'url'],
            'photo_urls' => ['required', 'array', 'min:2'],
            'photo_urls.*' => ['required', 'url'],
        ]);

        $model = VehicleModel::find($data['vehicle_model_id']);

        if (!$model || $model->brand_id !== (int) $data['brand_id']) {
            throw ValidationException::withMessages([
                'vehicle_model_id' => 'O modelo selecionado não pertence à marca escolhida.',
            ]);
        }

        $uniquePhotoCount = collect([$data['main_image_url'], ...$data['photo_urls']])
            ->filter()
            ->unique()
            ->count();

        if ($uniquePhotoCount < 3) {
            throw ValidationException::withMessages([
                'photo_urls' => 'Informe pelo menos três URLs de fotos únicas (incluindo a principal).',
            ]);
        }

        return $data;
    }

    /**
     * Synchronize vehicle photos ensuring the main image is primary.
     */
    protected function syncPhotos(Vehicle $vehicle, array $photoUrls, string $mainImageUrl): void
    {
        $vehicle->photos()->delete();

        // Ensure uniqueness to avoid duplication with primary vs gallery.
        $uniqueUrls = collect([$mainImageUrl, ...$photoUrls])
            ->filter()
            ->unique()
            ->values();

        $uniqueUrls->each(function ($url, $index) use ($vehicle, $mainImageUrl) {
            VehiclePhoto::create([
                'vehicle_id' => $vehicle->id,
                'url' => $url,
                'is_primary' => $url === $mainImageUrl || $index === 0,
            ]);
        });
    }
}
