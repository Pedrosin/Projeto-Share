@extends('layouts.dash_template')
@section('title', 'Dashboard')
@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <div class="card text-dark bg-light mb-3 shadow-sm">
        <div class="card-header">
            <h5>Publicações</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="publicacoes" class="table table-striped" style="width: 100%;">
                    <thead>
                        <th>Título</th>
                        <th>Data de início</th>
                        <th>Data fim</th>
                        <th>Disponível</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($data as $publicacao)
                            <tr>
                                <td>{{ $publicacao->titulo }}</td>
                                <td>{{ $publicacao->dt_inicio }}</td>
                                <td>{{ $publicacao->dt_fim }}</td>
                                @if ($publicacao->ativo == 1)
                                    <td>Sim</td>
                                @else
                                    <td>Não</td>
                                @endif
                                <td>
                                    @if ($publicacao->ativo == 1)
                                        @if ($publicacao->nr_doacoes > 0)
                                            <a href="ordens/{{ $publicacao->id }}" class=" text-decoration-none link-primary">
                                                <i class="bi bi-app-indicator" title="ordens"></i>
                                            </a>
                                        @endif
                                        <a href="editar-publicacao/{{ $publicacao->id }}"
                                            class="text-decoration-none link-success">
                                            <i class="bi bi-pencil-square" title="editar"></i>
                                        </a>
                                        <a href="inativar-publicacao/{{ $publicacao->id }}"
                                            class="text-decoration-none link-danger">
                                            <i class="bi bi-x-circle" title="inativar"></i>
                                        </a>
                                    @else
                                        <a href="reativar-publicacao/{{ $publicacao->id }}"
                                            class="text-decoration-none link-warning">
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
