@extends('layouts.app')

@section('title', $vehicle->brand->name . ' ' . $vehicle->model->name . ' ' . $vehicle->year)

@section('content')
    <nav aria-label="breadcrumb" class="text-sm text-slate-500 mb-6">
        <ol class="flex items-center gap-2">
            <li>
                <a href="{{ route('home') }}" class="hover:text-primary-600 transition">
                    Início
                </a>
            </li>
            <li aria-hidden="true">/</li>
            <li class="text-slate-400">{{ $vehicle->brand->name }} {{ $vehicle->model->name }}</li>
        </ol>
    </nav>

    <div class="grid lg:grid-cols-12 gap-8 items-start">
        <div class="lg:col-span-7 space-y-4">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="aspect-[16/9]">
                    <img src="{{ $vehicle->main_image_url }}" class="w-full h-full object-cover" alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}">
                </div>
            </div>
            @if($vehicle->photos->where('is_primary', false)->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($vehicle->photos->where('is_primary', false) as $photo)
                        <div class="rounded-2xl overflow-hidden bg-white shadow">
                            <div class="aspect-video">
                                <img src="{{ $photo->url }}" class="w-full h-full object-cover" alt="Foto adicional do veículo">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="lg:col-span-5">
            <div class="bg-white rounded-3xl shadow-xl p-8 space-y-6 border border-slate-100">
                <div class="space-y-2">
                    <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 text-primary-600 text-xs font-semibold px-3 py-1">
                        {{ $vehicle->brand->name }}
                    </span>
                    <h1 class="text-3xl font-semibold text-slate-900 leading-tight">
                        {{ $vehicle->brand->name }} {{ $vehicle->model->name }} {{ $vehicle->year }}
                    </h1>
                    <p class="text-3xl font-bold text-emerald-600">
                        R$ {{ number_format($vehicle->price, 2, ',', '.') }}
                    </p>
                </div>

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-slate-400 font-medium">Marca</dt>
                        <dd class="text-slate-700 font-semibold mt-1">{{ $vehicle->brand->name }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-slate-400 font-medium">Modelo</dt>
                        <dd class="text-slate-700 font-semibold mt-1">{{ $vehicle->model->name }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-slate-400 font-medium">Ano</dt>
                        <dd class="text-slate-700 font-semibold mt-1">{{ $vehicle->year }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-slate-400 font-medium">Cor</dt>
                        <dd class="text-slate-700 font-semibold mt-1">{{ $vehicle->color->name }}</dd>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <dt class="text-slate-400 font-medium">Quilometragem</dt>
                        <dd class="text-slate-700 font-semibold mt-1">{{ number_format($vehicle->mileage, 0, ',', '.') }} km</dd>
                    </div>
                </dl>

                <div class="space-y-3">
                    <h2 class="text-lg font-semibold text-slate-900">Descrição</h2>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $vehicle->description }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
