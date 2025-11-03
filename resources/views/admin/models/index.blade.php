@extends('layouts.app')

@section('title', 'Gerenciar modelos')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Modelos</h1>
            <p class="text-slate-500">Relacione modelos às suas respectivas marcas.</p>
        </div>
        <a href="{{ route('admin.models.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-2.5 text-white font-semibold shadow hover:bg-primary-700 transition">
            Novo modelo
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow border border-slate-100">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-slate-100">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Modelo</th>
                        <th class="px-6 py-3 font-medium">Marca</th>
                        <th class="px-6 py-3 font-medium text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($models as $model)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-700">{{ $model->name }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $model->brand->name }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.models.edit', $model) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">Editar</a>
                                    <form action="{{ route('admin.models.destroy', $model) }}" method="POST" onsubmit="return confirm('Deseja remover este modelo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-red-200 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-400">Nenhum modelo cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $models->links() }}
        </div>
    </div>
@endsection
