<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $brands = Brand::withCount('models')->orderBy('name')->paginate(10);

        return view('admin.brands.index', compact('brands'));
    }

    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:brands,name'],
            'country' => ['nullable', 'string', 'max:120'],
        ]);

        Brand::create($data);

        return redirect()
            ->route('admin.brands.index')
            ->with('status', 'Marca criada com sucesso.');
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:brands,name,' . $brand->id],
            'country' => ['nullable', 'string', 'max:120'],
        ]);

        $brand->update($data);

        return redirect()
            ->route('admin.brands.index')
            ->with('status', 'Marca atualizada com sucesso.');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        if ($brand->models()->exists()) {
            return redirect()
                ->route('admin.brands.index')
                ->with('error', 'Não é possível remover uma marca com modelos associados.');
        }

        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('status', 'Marca removida.');
    }
}
