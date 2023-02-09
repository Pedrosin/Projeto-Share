@extends('layouts.dash_template')
@section('title','Editar Projeto')
@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5>Editar Projeto</h5>
    </div>
    <div class="card-body">
        <div class="alert alert-warning">
            <p class="card-text">Preencha todos os campos obrigatórios <span class="required"> *</span></p>
        </div>
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <p class="card-text">{{$error}}</p>
        </div>
        @endforeach
        <form action="/editar-projeto" method="POST" id="form-editar-projeto" class="row g-3">
            @csrf
            <div class="col-md-12 row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="name">Nome<span class="required"> *</span></label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Como você gostaria de ser chamado?" value="{{ $data->name }}" />
                    <input type="hidden" name="id" value="{{ $data->id }}" >
                    @error('name')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-8">
                    <label class="form-label" for="email">E-mail<span class="required"> *</span></label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" value="{{ $data->email }}" />
                    @error('email')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="celular" class="form-label">Celular<span class="required"> *</span></label>
                    <input type="text" class="form-control sp_celphones" maxlength="15" id="celular" name="celular" value="{{ $data->celular }}" placeholder="Digite seu número de contato">
                    @error('celular')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="cep" class="form-label">CEP<span class="required"> *</span></label>
                    <input type="text" class="form-control cep" id="cep" name="cep" value="{{ $data->cep }}" placeholder="Digite seu CEP">
                    @error('cep')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="cidade" class="form-label">Cidade<span class="required"> *</span></label>
                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ $data->cidade }}" placeholder="Cidade">
                    @error('cidade')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="uf" class="form-label">Estado<span class="required"> *</span></label>
                    <select class="form-select custom-uf" name="uf" id="uf" value="{{ $data->uf }}">

                    </select>
                    @error('uf')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="rua" class="form-label">Rua<span class="required"> *</span></label>
                    <input type="text" class="form-control" id="rua" name="rua" value="{{ $data->rua }}" placeholder="Rua">
                    @error('rua')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="bairro" class="form-label">Bairro<span class="required"> *</span></label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{ $data->bairro }}" placeholder="Bairro">
                    @error('bairro')
                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" class="form-control" id="complemento" name="complemento" value="{{ $data->complemento }}" placeholder="Complemento">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection