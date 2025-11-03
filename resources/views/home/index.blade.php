@extends('layouts.app')

@section('title', 'Veículos disponíveis')

@section('content')
    <section class="bg-white rounded-3xl shadow-xl px-6 py-10 md:px-12 md:py-14 overflow-hidden relative">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div class="space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 text-primary-600 text-sm font-medium px-4 py-1">
                    <span class="w-2 h-2 rounded-full bg-primary-600"></span>
                    Nova frota selecionada
                </span>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-slate-900">
                    Encontre o carro perfeito para a próxima conquista.
                </h1>
                <p class="text-lg text-slate-600">
                    Explore nossa seleção premium com procedência garantida, revisões em dia e condições especiais para tornar sua jornada mais emocionante.
                </p>
                <a href="#catalogo" class="inline-flex items-center gap-2 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-full px-6 py-3 shadow-lg shadow-primary-600/30 hover:scale-105 transition">
                    Ver catálogo completo
                    <span aria-hidden="true" class="text-xl">→</span>
                </a>
            </div>
            <div class="relative">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-primary-100 rounded-full blur-3xl opacity-60 pointer-events-none"></div>
                <img src="https://images.pexels.com/photos/97079/pexels-photo-97079.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=640" class="relative rounded-3xl shadow-2xl ring-4 ring-white/50 object-cover w-full h-full" alt="Carro esportivo vermelho">
            </div>
        </div>
    </section>

    <section id="catalogo" class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900">Veículos em destaque</h2>
                <p class="text-slate-500">Escolha entre opções verificadas e atualizadas diariamente.</p>
            </div>
            <span class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 bg-white rounded-full px-4 py-2 shadow">
                <span class="w-2 h-2 rounded-full bg-primary-500"></span>
                {{ $vehicles->total() }} resultados
            </span>
        </div>

        @if($vehicles->isEmpty())
            <div class="text-center py-12 bg-white shadow rounded-3xl">
                <p class="text-lg text-slate-500">Ainda não temos veículos cadastrados. Volte em breve!</p>
            </div>
        @else
            <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                @foreach($vehicles as $vehicle)
                    <div class="group bg-white rounded-3xl shadow hover:shadow-2xl transition overflow-hidden border border-slate-100">
                        <div class="relative h-56 overflow-hidden">
                            <img src="{{ $vehicle->main_image_url }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent"></div>
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full bg-white/90 text-primary-600 text-xs font-semibold backdrop-blur">
                                    {{ $vehicle->brand->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-start justify-between">
                                <h3 class="text-xl font-semibold text-slate-900">
                                    {{ $vehicle->model->name }} {{ $vehicle->year }}
                                </h3>
                                <span class="text-lg font-bold text-emerald-600">
                                    R$ {{ number_format($vehicle->price, 2, ',', '.') }}
                                </span>
                            </div>
                            <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm text-slate-500">
                                <div>
                                    <dt class="font-medium text-slate-400">Cor</dt>
                                    <dd class="text-slate-600">{{ $vehicle->color->name }}</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-slate-400">Quilometragem</dt>
                                    <dd class="text-slate-600">{{ number_format($vehicle->mileage, 0, ',', '.') }} km</dd>
                                </div>
                            </dl>
                            <a href="{{ route('vehicles.show', $vehicle) }}" class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-primary-100 bg-primary-50 text-primary-600 font-semibold py-3 hover:bg-primary-600 hover:text-white transition">
                                Ver detalhes
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div>
                {{ $vehicles->links() }}
            </div>
        @endif
    </section>
@endsection
