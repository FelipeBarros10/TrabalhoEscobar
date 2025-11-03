@extends('layouts.app')

@section('title', 'Nova cor')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Cadastrar cor</h1>
            <p class="text-slate-500">Defina uma nova cor para o catálogo.</p>
        </div>
        <div class="bg-white rounded-3xl shadow border border-slate-100 p-6 md:p-8">
            <form action="{{ route('admin.colors.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('admin.colors._form')
            </form>
        </div>
    </div>
@endsection
