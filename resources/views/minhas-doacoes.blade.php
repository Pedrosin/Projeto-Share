@extends('layouts.template')
@section('title', 'Minhas doações')
@section('content')
    <div class="container mt-3">
        <div class="card text-dark bg-light mb-3 shadow-sm">
            <div class="card-header">
                <h5>Minhas doações</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="publicacoes" class="table table-striped" style="width: 100%;">
                        <thead>
                            <th>Campanha</th>
                            <th>Data da doação</th>
                            <th>Forma</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $doacao)
                                <tr>
                                    <td>{{ $doacao->titulo }}</td>
                                    <td>{{ $doacao->created_at }}</td>
                                    <td>{{ $doacao->nm_tipo }}</td>
                                    <td>{{ $doacao->nm_situacao }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
