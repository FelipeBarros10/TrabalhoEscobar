@extends('layouts.app')

@section('title', 'Entrar na plataforma')

@section('content')
    <div class="flex justify-center">
        <div class="w-full max-w-lg">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 md:p-10">
                <div class="space-y-3 text-center mb-6">
                    <h1 class="text-3xl font-bold text-slate-900">Bem-vindo de volta</h1>
                    <p class="text-slate-500">Acesse o painel administrativo e mantenha o estoque atualizado.</p>
                </div>
                <form action="{{ route('login.perform') }}" method="POST" novalidate class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-600">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-600">Senha</label>
                        <input type="password" id="password" name="password" required class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-100">
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <label class="inline-flex items-center gap-2 text-slate-500">
                            <input type="checkbox" value="1" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                            Manter-me conectado
                        </label>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center rounded-2xl bg-primary-600 px-5 py-3 text-white font-semibold shadow-lg shadow-primary-600/30 hover:bg-primary-700 transition">
                        Entrar
                    </button>
                </form>
                <p class="text-center text-sm text-slate-500 mt-6">
                    Ainda não tem conta? <a href="{{ route('register') }}" class="text-primary-600 font-semibold hover:text-primary-700">Crie agora</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
