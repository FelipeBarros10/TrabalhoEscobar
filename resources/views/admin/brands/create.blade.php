@extends('layouts.app')

@section('title', 'Nova marca')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Cadastrar marca</h1>
            <p class="text-slate-500">Insira as informações da nova marca.</p>
        </div>
        <div class="bg-white rounded-3xl shadow border border-slate-100 p-6 md:p-8">
            <form action="{{ route('admin.brands.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('admin.brands._form')
            </form>
        </div>
    </div>
@endsection
