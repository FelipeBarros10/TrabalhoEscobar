@extends('layouts.app')

@section('title', 'Gerenciar veículos')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Veículos</h1>
            <p class="text-slate-500">Controle completo do estoque disponível.</p>
        </div>
        <a href="{{ route('admin.vehicles.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-2.5 text-white font-semibold shadow hover:bg-primary-700 transition">
            Novo veículo
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow border border-slate-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100 text-sm">
                <thead class="bg-slate-50 text-left text-slate-500 uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Veículo</th>
                        <th class="px-6 py-3 font-semibold">Marca</th>
                        <th class="px-6 py-3 font-semibold">Cor</th>
                        <th class="px-6 py-3 font-semibold">Ano</th>
                        <th class="px-6 py-3 font-semibold">Preço</th>
                        <th class="px-6 py-3 font-semibold">Fotos</th>
                        <th class="px-6 py-3 font-semibold text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($vehicles as $vehicle)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $vehicle->main_image_url }}" alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}" class="h-16 w-24 rounded-xl object-cover shadow">
                                    <div>
                                        <p class="text-slate-800 font-semibold">{{ $vehicle->brand->name }} {{ $vehicle->model->name }}</p>
                                        <p class="text-xs text-slate-500 uppercase tracking-wider">{{ number_format($vehicle->mileage, 0, ',', '.') }} km</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->brand->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->color->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->year }}</td>
                            <td class="px-6 py-4 text-emerald-600 font-semibold">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $vehicle->photos_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('vehicles.show', $vehicle) }}" target="_blank" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">Ver</a>
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">Editar</a>
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Deseja remover este veículo? Esta ação não pode ser desfeita.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-red-200 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-slate-400">Nenhum veículo cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $vehicles->links() }}
        </div>
    </div>
@endsection
