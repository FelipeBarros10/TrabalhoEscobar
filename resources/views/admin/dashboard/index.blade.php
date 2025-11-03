@extends('layouts.app')

@section('title', 'Painel administrativo')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Painel administrativo</h1>
            <p class="text-slate-500">Gerencie marcas, modelos, cores e veículos da concessionária.</p>
        </div>
        <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-3 text-white font-semibold shadow-lg shadow-primary-600/30 hover:bg-primary-700 transition">
            Novo veículo
        </a>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div class="rounded-3xl bg-white border border-slate-100 shadow p-6">
            <p class="text-sm text-slate-500">Veículos publicados</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $metrics['vehicle_count'] }}</p>
        </div>
        <div class="rounded-3xl bg-white border border-slate-100 shadow p-6">
            <p class="text-sm text-slate-500">Marcas cadastradas</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $metrics['brand_count'] }}</p>
        </div>
        <div class="rounded-3xl bg-white border border-slate-100 shadow p-6">
            <p class="text-sm text-slate-500">Modelos cadastrados</p>
            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $metrics['model_count'] }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <a href="{{ route('admin.brands.index') }}" class="group rounded-3xl border border-slate-100 bg-white p-6 shadow hover:border-primary-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-primary-500">Cadastros</p>
                    <h2 class="mt-2 text-xl font-semibold text-slate-800">Marcas</h2>
                    <p class="mt-2 text-sm text-slate-500">Gerencie fabricantes e mantenha o catálogo organizado.</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-50 text-primary-600 text-lg font-semibold">
                    →
                </span>
            </div>
        </a>
        <a href="{{ route('admin.models.index') }}" class="group rounded-3xl border border-slate-100 bg-white p-6 shadow hover:border-primary-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-primary-500">Cadastros</p>
                    <h2 class="mt-2 text-xl font-semibold text-slate-800">Modelos</h2>
                    <p class="mt-2 text-sm text-slate-500">Associe modelos às marcas e mantenha as opções atualizadas.</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-50 text-primary-600 text-lg font-semibold">
                    →
                </span>
            </div>
        </a>
        <a href="{{ route('admin.colors.index') }}" class="group rounded-3xl border border-slate-100 bg-white p-6 shadow hover:border-primary-200 hover:shadow-lg transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-primary-500">Cadastros</p>
                    <h2 class="mt-2 text-xl font-semibold text-slate-800">Cores</h2>
                    <p class="mt-2 text-sm text-slate-500">Padronize as cores disponíveis para os veículos cadastrados.</p>
                </div>
                <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-primary-50 text-primary-600 text-lg font-semibold">
                    →
                </span>
            </div>
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow border border-slate-100">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600 uppercase tracking-wider">Últimos veículos cadastrados</span>
            <a href="{{ route('admin.vehicles.index') }}" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Ver todos</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50">
                    <tr class="text-left text-slate-500">
                        <th class="px-6 py-3 font-medium">Veículo</th>
                        <th class="px-6 py-3 font-medium">Marca</th>
                        <th class="px-6 py-3 font-medium">Modelo</th>
                        <th class="px-6 py-3 font-medium">Criado em</th>
                        <th class="px-6 py-3 font-medium text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($latestVehicles as $vehicle)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4 text-slate-700 font-semibold">{{ $vehicle->brand->name }} {{ $vehicle->model->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->brand->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->model->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-400">Nenhum veículo cadastrado ainda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
