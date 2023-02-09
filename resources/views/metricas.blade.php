@extends('layouts.dash_template')
@section('title', 'Métricas')
@section('content')
    @if (session()->has('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
    <div class="card text-dark bg-light mb-3 shadow-sm">
        <div class="card-header">
            <h5>Métricas</h5>
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-xs-8 col-sm-4 col-md-3">
                    <label for="metrica-geral-principal" class="form-label">Filtrar Publicações</label>
                    <div id="metricas-range">
                        <input type="text" id="filtro-metrica-geral" class="form-control">
                    </div>
                </div>
                <div class="col-xs-2 col-sm-4 col-md-2 d-flex align-items-end">
                    <button class="btn btn-success form-control" id="btnGerarExcel">
                        Gerar Excel <i class="bi bi-filetype-xlsx"></i>
                    </button>
                </div>
                <div class="col-xs-2 col-sm-4 col-md-2 d-flex align-items-end" id="btnGerarPdf">
                    <button class="btn btn-danger form-control">
                        Gerar PDF <i class="bi bi-filetype-pdf"></i>
                    </button>
                </div>
                <div class="col-xs-2 col-sm-4 col-md-2 d-flex align-items-end" id="btnGerarCsv">
                    <button class="btn btn-primary form-control">
                        Gerar CSV <i class="bi bi-filetype-csv"></i>
                    </button>
                </div>
                <div class="col-xs-2 col-sm-4 col-md-2 d-flex align-items-end" id="btnGerarHtml">
                    <button class="btn btn-dark form-control">
                        Gerar HTML <i class="bi bi-filetype-html"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="md-8 my-5">
                    <canvas id="myChart" class="shadow-sm" style="max-height: 400px;background-color: #fff;"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-script')
    {{-- Métricas JS --}}
    <script type="text/javascript" src="/js/funcoesMetricas.js"></script>
@endsection