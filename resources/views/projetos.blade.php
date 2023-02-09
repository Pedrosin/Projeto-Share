@extends('layouts.dash_template')
@section('title','Gerenciar projetos')
@section('content')
@if ( session()->has('success') )
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="card text-dark bg-light mb-3 shadow-sm">
    <div class="card-header">
        <h5>Projetos</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="projetos" class="table table-striped" style="width: 100%;">
                <thead>
                    <th>Id</th>
                    <th>Nome do Projeto</th>
                    <th>Data de Cadastro</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </thead>
                <tbody>
                    @foreach ($data as $projeto)
                    <tr>
                        <td>{{ $projeto->id  }}</td>
                        <td>{{ $projeto->name  }}</td>
                        <td>{{ $projeto->created_at->format('d/m/Y H:i:s')}}</td>
                        @if( $projeto->ativo == 1)
                        <td>Sim</td>
                        @else
                        <td>Não</td>
                        @endif
                        <!-- <td>{{ $projeto->ativo  }}</td> -->
                        <td>

                            <a href="editar-projeto/{{ $projeto->id }}" class="text-decoration-none link-success">
                                <i class="bi bi-pencil-square" title="editar"></i>
                            </a>
                            @if($projeto->ativo == 1)
                            <a href="inativar-projeto/{{ $projeto->id }}" class="text-decoration-none link-danger">
                                <i class="bi bi-x-circle" title="inativar"></i>
                            </a>
                            @else
                            <a href="reativar-projeto/{{ $projeto->id }}" class="text-decoration-none link-warning">
                                <i class="bi bi-lightning-charge" title="reativar"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection