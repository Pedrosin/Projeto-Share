@extends('layouts.explorar')
@section('title','Share - Projetos')
@section('content')

{{-- Mapa --}}
<div id="map-container">
    <div id="map">

    </div>
    <div id="visualizar-projetos">
        <button class="btn btn-share" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasListaProjetos" aria-controls="offcanvasListaProjetos">
            Visualizar projetos
        </button>
    </div>
</div>

{{-- Modal Publicações --}}
<div class="modal fade" id="publicacoesModal" tabindex="-1" aria-labelledby="publicacoesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publicacoesModalLabel"><span class="nome_campanha"></span> - Publicações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="conteudo">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Contribuir --}}
<div class="modal fade" id="contribuirModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticContribuirModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contribuirModalLabel"><span class="nome_projeto"></span> - Campanha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="info-doacao">
                {{-- Publicacões são geradas aqui --}}
            </div>
            <div class="modal-footer">
                @auth
                <button class="btn btn-share" id="criarOrdem" onclick="criarOrdemDoacao({{ auth()->user()->id }})">Confirmar doação</button>
                @endauth
                <button class="btn btn-share" data-bs-target="#publicacoesModal" data-bs-toggle="modal" data-bs-dismiss="modal">Voltar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Aviso --}}
<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="publicacoesModalLabel"><span class="titulo_aviso"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="conteudo_aviso">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Confirmação --}}
<div class="modal fade" id="confirmacaoModal" tabindex="-1" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="col-md-12 text-center">
                    <div class="row text-success">
                        <i class="bi bi-check-circle" id="confirmacao-icon"></i>
                    </div>
                    <div class="row">
                        <div class="p-2">Obrigado pela sua contribuição!</div>
                        <div class="p-2">
                            <a href="/minhas-doacoes" class="btn btn-success">Acompanhar doação</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

{{-- Offcanvas Projetos --}}
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasListaProjetos" aria-labelledby="offcanvasListaProjetosLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasListaProjetosLabel">Lista de projetos</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body listings" id="listings">
    </div>
</div>
@endsection