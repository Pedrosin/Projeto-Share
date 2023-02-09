@extends('layouts.template')
@section('title','Registrar')
@section('content')
<section>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center form-config py-5">
            <div class="col-10">
                <div class="card rounded-3 text-black shadow-sm">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card-header bg-card-register bg-light d-flex justify-content-center align-items-center h-100 p-3">
                                <div class="text-center text-auth">
                                    <img src="/img/logo.png" class="w-25" alt="logo">
                                    <h4>Crie a sua conta</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <form action="/register" method="POST" id="form-registro" class="row g-3">
                                    @csrf
                                    <h5 class="card-title">Informações Gerais</h5>
                                    <div class="alert alert-warning">
                                        <p class="card-text">Preencha todos os campos obrigatórios <span class="required"> *</span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="name">Nome<span class="required"> *</span></label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Como você gostaria de ser chamado?" value="{{ old('name') }}" />
                                        @error('name')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="email">E-mail<span class="required"> *</span></label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" value="{{ old('email') }}" />
                                        @error('email')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label" for="password">Senha<span class="required"> *</span></label>
                                        <input type="password" id="password" name="password" class="form-control" />
                                        @error('password')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="celular" class="form-label">Celular<span class="required"> *</span></label>
                                        <input type="text" class="form-control sp_celphones" maxlength="15" id="celular" name="celular" value="{{ old('celular') }}" placeholder="Digite seu número de contato">
                                        @error('celular')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cep" class="form-label">CEP<span class="required"> *</span></label>
                                        <input type="text" class="form-control cep" id="cep" name="cep" value="{{ old('cep') }}" placeholder="Digite seu CEP">
                                        @error('cep')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="cidade" class="form-label">Cidade<span class="required"> *</span></label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}" placeholder="Cidade">
                                        @error('cidade')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-3">
                                        <label for="uf" class="form-label">Estado<span class="required"> *</span></label>
                                        <!-- "{{ old('uf') }}" -->
                                        <select class="form-select" name="uf" id="uf" value="{{ old('uf') }}">

                                        </select>
                                        @error('uf')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="rua" class="form-label">Rua<span class="required"> *</span></label>
                                        <input type="text" class="form-control" id="rua" name="rua" value="{{ old('rua') }}" placeholder="Rua">
                                        @error('rua')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="complemento" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento') }}" placeholder="Complemento">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="bairro" class="form-label">Bairro<span class="required"> *</span></label>
                                        <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}" placeholder="Bairro">
                                        @error('bairro')
                                        <p class="text-danger mb-0">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <input class="form-check-input" type="checkbox" value="2" id="tipo" name="tipo" />
                                        <label class="form-check-label" for="tipo"> Sou um projeto social </label>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-share" type="submit"> Registrar </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection