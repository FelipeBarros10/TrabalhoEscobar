<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ColorController extends Controller
{
    public function index(): View
    {
        $colors = Color::orderBy('name')->paginate(10);

        return view('admin.colors.index', compact('colors'));
    }

    public function create(): View
    {
        return view('admin.colors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:colors,name'],
            'hex_code' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ]);

        Color::create($data);

        return redirect()
            ->route('admin.colors.index')
            ->with('status', 'Cor criada com sucesso.');
    }

    public function edit(Color $color): View
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(Request $request, Color $color): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:colors,name,' . $color->id],
            'hex_code' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ]);

        $color->update($data);

        return redirect()
            ->route('admin.colors.index')
            ->with('status', 'Cor atualizada com sucesso.');
    }

    public function destroy(Color $color): RedirectResponse
    {
        if ($color->vehicles()->exists()) {
            return redirect()
                ->route('admin.colors.index')
                ->with('error', 'Não é possível remover uma cor que está em uso por veículos.');
        }

        $color->delete();

        return redirect()
            ->route('admin.colors.index')
            ->with('status', 'Cor removida.');
    }
}

