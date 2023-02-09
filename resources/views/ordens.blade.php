@extends('layouts.dash_template')
@section('title', 'Atualizar doações')
@section('content')
@if (session()->has('success'))
<p class="alert alert-success">{{ session('success') }}</p>
@endif
<div class="card text-dark bg-light mb-3 shadow-sm">
    <div class="card-header">
        <h5>Atualizar doações</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="publicacoes" class="table table-striped" style="width: 100%;">
                <thead>
                    <th>Campanha</th>
                    <th>Doador</th>
                    <th>Data da doação</th>
                    <th>Forma</th>
                    <th>Status</th>
                    <th>Ação</th>
                </thead>
                <tbody>
                    @foreach ($data as $ordem)
                    <tr>
                        <td>{{ $ordem->titulo }}</td>
                        <td>{{ $ordem->name }}</td>
                        <td>{{ $ordem->created_at }}</td>
                        <td>{{ $ordem->nm_tipo }}</td>
                        <td>{{ $ordem->nm_situacao }}</td>
                        <td>
                            <a href="#" class="carregarStatus" data-id="{{ $ordem->id }}" data-situacao="{{ $ordem->id_situacao }}" class="text-decoration-none link-success">
                                <i class="bi bi-check-circle" title="Atualizar Status"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Atualizar Status Da Doação --}}
<div class="modal fade" id="atualizarStatusDoacaoModal" tabindex="-1" aria-labelledby="atualizarStatusDoacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="atualizarStatusDoacao">Atualizar Status da Doação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <label for="situacao_status" class="form-label">Definir situação:</label>
                    <select class="form-select" name="situacao_status" id="situacao_status">
                        <option value="1">Pendente</option>
                        <option value="2">Confirmado</option>
                        <option value="3">Cancelado</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-share" id="btn-atualizar-status">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="span-spinner"></span>
                    <span id="text-update">Atualizar</span>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection