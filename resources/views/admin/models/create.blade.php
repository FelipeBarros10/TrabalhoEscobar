@extends('layouts.app')

@section('title', 'Novo modelo')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Cadastrar modelo</h1>
            <p class="text-slate-500">Preencha os dados do novo modelo.</p>
        </div>
        <div class="bg-white rounded-3xl shadow border border-slate-100 p-6 md:p-8">
            <form action="{{ route('admin.models.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('admin.models._form')
            </form>
        </div>
    </div>
@endsection
