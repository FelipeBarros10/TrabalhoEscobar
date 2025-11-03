@extends('layouts.app')

@section('title', 'Novo veículo')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Cadastrar veículo</h1>
            <p class="text-slate-500">Preencha os dados do veículo que estará disponível na vitrine pública.</p>
        </div>
        <div class="bg-white rounded-3xl shadow border border-slate-100 p-6 md:p-8">
            <form action="{{ route('admin.vehicles.store') }}" method="POST" class="space-y-6">
                @csrf
                @php($vehicle = null)
                @php($additionalPhotos = [])
                @include('admin.vehicles._form')
            </form>
        </div>
    </div>
@endsection
