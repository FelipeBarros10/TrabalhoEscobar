@extends('layouts.app')

@section('title', 'Editar modelo')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Editar modelo</h1>
            <p class="text-slate-500">Atualize as informações de {{ $model->name }}.</p>
        </div>
        <div class="bg-white rounded-3xl shadow border border-slate-100 p-6 md:p-8">
            <form action="{{ route('admin.models.update', $model) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                @include('admin.models._form')
            </form>
        </div>
    </div>
@endsection
