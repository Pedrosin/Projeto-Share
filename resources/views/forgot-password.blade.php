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
                                <h4>Redefinir senha</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('password.request') }}" method="POST" class="row g-3">
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
                                @if (session()->has('email'))
                                    <div class="alert alert-error">
                                        {{ session('email') }}
                                    </div>
                                @endif

                                @csrf

                                <div class="col-md-12">
                                    <label class="form-label" for="email">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Digite o e-mail da sua conta" value="{{ old('email') }}" />
                                    @error('email')
                                        <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-share" type="submit"> Enviar </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
