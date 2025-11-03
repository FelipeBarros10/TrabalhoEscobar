<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleModelController extends Controller
{
    public function index(): View
    {
        $models = VehicleModel::with('brand')
            ->orderBy(Brand::select('name')->whereColumn('brands.id', 'vehicle_models.brand_id'))
            ->orderBy('name')
            ->paginate(10);

        return view('admin.models.index', compact('models'));
    }

    public function create(): View
    {
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.models.create', compact('brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:120'],
        ]);

        $exists = VehicleModel::where('brand_id', $data['brand_id'])
            ->where('name', $data['name'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'Já existe um modelo com este nome para a marca selecionada.']);
        }

        VehicleModel::create($data);

        return redirect()
            ->route('admin.models.index')
            ->with('status', 'Modelo criado com sucesso.');
    }

    public function edit(VehicleModel $model): View
    {
        $brands = Brand::orderBy('name')->pluck('name', 'id');

        return view('admin.models.edit', compact('model', 'brands'));
    }

    public function update(Request $request, VehicleModel $model): RedirectResponse
    {
        $data = $request->validate([
            'brand_id' => ['required', 'exists:brands,id'],
            'name' => ['required', 'string', 'max:120'],
        ]);

        $exists = VehicleModel::where('brand_id', $data['brand_id'])
            ->where('name', $data['name'])
            ->where('id', '!=', $model->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['name' => 'Já existe um modelo com este nome para a marca selecionada.']);
        }

        $model->update($data);

        return redirect()
            ->route('admin.models.index')
            ->with('status', 'Modelo atualizado com sucesso.');
    }

    public function destroy(VehicleModel $model): RedirectResponse
    {
        if ($model->vehicles()->exists()) {
            return redirect()
                ->route('admin.models.index')
                ->with('error', 'Não é possível remover um modelo com veículos associados.');
        }

        $model->delete();

        return redirect()
            ->route('admin.models.index')
            ->with('status', 'Modelo removido.');
    }
}

