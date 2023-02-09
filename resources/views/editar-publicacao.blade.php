@extends('layouts.dash_template')
@section('title','Editar Publicações')
@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5>Editar publicação</h5>
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
        <form action="/editar-publicacao" method="POST" id="form-editar-campanha" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <label for="titulo" class="form-label">Título da campanha<span class="required"> *</span></label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Digite o título da campanha, Ex: Arrecadações para ajudar pessoas no natal" value="{{ $data->titulo }}">
                <input type="hidden" name="id" value="{{ $id }}" >
                @error('titulo')
                <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição<span class="required"> *</span></label>
                <textarea class="form-control" name="descricao" id="descricao" rows="2" placeholder="Conte um pouco sobre a campanha criada">{{ $data->descricao }}</textarea>
                @error('descricao')
                <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="imagem" class="form-label">Imagem da campanha<span class="required"> *</span></label>
                <input class="form-control" type="file" name="imagem" id="imagem">
            </div>
            <div class="col-6">
                <label for="tipo" class="form-label">Forma de recebimento<span class="required"> *</span></label>
                <select name="tipo" id="tipo" class="form-select">
                    <option>Escolha...</option>
                    <option value="1" {{ $data->id_tipo == '1' ? 'selected' : '' }}>Pix</option>
                    <option value="2" {{ $data->id_tipo == '2' ? 'selected' : '' }}>Entrega no projeto</option>
                    <option value="3" {{ $data->id_tipo == '3' ? 'selected' : '' }}>Ambas</option>
                </select>
                @error('tipo')
                <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="dt_inicio" class="form-label">Data de início<span class="required"> *</span></label>
                <input type="text" class="form-control data" name="dt_inicio" id="dt_inicio" value="{{  $data->dt_inicio }}" placeholder="DD/MM/AAAA" title="Insira uma data no formato DD/MM/AAAA">
                @error('dt_inicio')
                <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="dt_fim" class="form-label">Data fim<span class="required"> *</span></label>
                <input type="text" class="form-control data" name="dt_fim" id="dt_fim" value="{{ $data->dt_fim }}" placeholder="DD/MM/AAAA" title="Insira uma data no formato DD/MM/AAAA">
                @error('dt_fim')
                <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                <img src="{{$data->path_imagem}}" class="img-thumbnail">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Atualizar campanha</button>
            </div>
        </form>
    </div>
</div>
@endsection