<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'AutoPrime Motors')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['"Montserrat"', 'ui-sans-serif', 'system-ui'],
                        },
                        colors: {
                            primary: {
                                DEFAULT: '#6366F1',
                                50: '#EEF2FF',
                                100: '#E0E7FF',
                                600: '#4F46E5',
                                700: '#4338CA',
                            },
                        },
                    },
                },
            };
        </script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen flex flex-col bg-slate-100 text-slate-800">
        <header class="bg-gradient-to-r from-primary-600 to-primary-700 text-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold tracking-wide">
                            AutoPrime Motors
                        </a>
                        <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
                            <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) text-white @else text-white/70 hover:text-white @endif transition">
                                Veículos
                            </a>
                            @auth
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="@if(request()->is('admin*')) text-white @else text-white/70 hover:text-white @endif transition">
                                        Admin
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        @guest
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-full border border-white/20 text-white hover:bg-white/10 transition">
                                Entrar
                            </a>
                            <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-white text-primary-600 font-semibold hover:bg-slate-100 transition">
                                Criar conta
                            </a>
                        @else
                            <span class="hidden sm:inline text-white/80">Olá, {{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 rounded-full bg-white text-primary-600 font-semibold hover:bg-slate-100 transition">
                                    Sair
                                </button>
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="md:hidden border-t border-white/10">
                <nav class="max-w-7xl mx-auto px-4 py-3 flex items-center gap-4 text-sm font-medium text-white/80">
                    <a href="{{ route('home') }}" class="@if(request()->routeIs('home')) text-white @else hover:text-white @endif">Veículos</a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="@if(request()->is('admin*')) text-white @else hover:text-white @endif">Admin</a>
                        @endif
                    @endauth
                </nav>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
                @if(session('status'))
                    <div class="rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-green-700 shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-red-700 shadow-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="rounded-xl border border-red-100 bg-red-50 px-4 py-4 text-red-600 shadow-sm space-y-3">
                        <p class="font-semibold">Ops! Verifique os campos a seguir:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="bg-slate-900 text-slate-400 py-6">
            <div class="max-w-7xl mx-auto px-4 text-center text-sm space-y-1">
                <p class="text-white font-semibold tracking-wide">AutoPrime Motors</p>
                <p>Conectando você ao carro dos seus sonhos.</p>
            </div>
        </footer>

        @stack('scripts')
    </body>
</html>
