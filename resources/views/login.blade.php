@extends('layouts.template')
@section('title', 'Entrar')
@section('content')
    <section>
        <div class="container">
            <div class="d-flex justify-content-center align-items-center form-config py-5">
                <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    <div class="card rounded-3 text-black shadow-sm">
                        <div class="card-header bg-card-login bg-light d-flex justify-content-center align-items-center p-3">
                            <div class="text-center text-auth">
                                <img src="/img/logo.png" class="w-25" alt="logo">
                                <h4>Entrar na conta</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="/login" method="POST" id="form-login" class="row g-3">
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session()->has('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-error">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @error('credenciais')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @csrf

                                <div class="col-md-12">
                                    <label class="form-label" for="email">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Digite o e-mail da sua conta" value="{{ old('email') }}" />
                                    @error('email')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="password">Senha</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Digite sua senha" />
                                    <p class="text-muted mb-0">
                                        <a href="/forgot-password" class="link-share">Esqueceu a senha? </a>
                                    </p>
                                    @error('password')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-share" type="submit"> Entrar </button>
                                    </div>
                                    @unless(auth()->check())
                                        <p class="text-muted mt-1">
                                            Não tem uma conta? <a href="/register" class="link-share">Crie uma!</a>
                                        </p>
                                    @endunless
                                </div>
                            </form>
                            <p class="custom-divider text-center pt-2 mb-0">Ou</p>
                            <div class="d-flex justify-content-around align-items-center">
                                <div class="item d-flex flex-column align-items-center">
                                    <a href="{{ route('auth.github') }}" class="link-dark">
                                        <i class="bi bi-github"></i>
                                    </a>
                                    <span>Github</span>
                                </div>
                                <div class="item d-flex flex-column align-items-center text-primary" class="link-dark">
                                    <a href="{{ route('auth.google') }}">
                                        <i class="bi bi-google"></i>
                                    </a>
                                    <span>Google</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
