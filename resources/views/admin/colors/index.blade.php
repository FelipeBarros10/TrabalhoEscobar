@extends('layouts.app')

@section('title', 'Gerenciar cores')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Cores</h1>
            <p class="text-slate-500">Mantenha o catálogo de cores atualizado.</p>
        </div>
        <a href="{{ route('admin.colors.create') }}" class="inline-flex items-center gap-2 rounded-2xl bg-primary-600 px-5 py-2.5 text-white font-semibold shadow hover:bg-primary-700 transition">
            Nova cor
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow border border-slate-100">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-slate-100">
                <thead class="bg-slate-50 text-left text-slate-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Nome</th>
                        <th class="px-6 py-3 font-medium">Código</th>
                        <th class="px-6 py-3 font-medium text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($colors as $color)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-semibold text-slate-700">{{ $color->name }}</td>
                            <td class="px-6 py-4">
                                @if($color->hex_code)
                                    <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600">
                                        <span class="w-3.5 h-3.5 rounded-full border border-white shadow" style="background-color: {{ $color->hex_code }}"></span>
                                        {{ $color->hex_code }}
                                    </span>
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.colors.edit', $color) }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">Editar</a>
                                    <form action="{{ route('admin.colors.destroy', $color) }}" method="POST" onsubmit="return confirm('Deseja remover esta cor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-red-200 px-4 py-2 text-xs font-semibold text-red-600 hover:bg-red-50 transition">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-10 text-center text-slate-400">Nenhuma cor cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $colors->links() }}
        </div>
    </div>
@endsection
