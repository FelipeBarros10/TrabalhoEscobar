@extends('layouts.app')

@section('title', 'Criar conta')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-10">
                <div class="space-y-3 text-center mb-6">
                    <h1 class="text-3xl font-bold text-slate-900">Crie sua conta gratuita</h1>
                    <p class="text-slate-500">Cadastre-se e tenha acesso às ferramentas administrativas.</p>
                </div>
                <form action="{{ route('register.perform') }}" method="POST" novalidate class="space-y-5">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-600">Nome completo</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-600">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                    </div>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-slate-600">Senha</label>
                            <input type="password" id="password" name="password" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-slate-600">Confirmar senha</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                        </div>
                    </div>
                    <p class="text-xs text-slate-400">Sua senha deve conter ao menos 8 caracteres, letras maiúsculas/minúsculas, números e símbolos.</p>
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-2xl bg-primary-600 px-5 py-3 text-white font-semibold shadow-lg shadow-primary-600/30 hover:bg-primary-700 transition">
                        Cadastrar
                    </button>
                </form>
                <p class="text-center text-sm text-slate-500 mt-6">
                    Já possui cadastro? <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:text-primary-700">Entrar</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
