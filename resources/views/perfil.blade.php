@extends('layouts.template')
@section('title', 'Perfil')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center form-config">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 p-5">
                <div class="card rounded-3 text-black shadow-sm">
                    <div class="card-body">
                        <div class="text-center text-light">
                            <img src="/img/profile_icons/{{ $profile_icon->nm_icon }}" id="profile-icon" class="img-fluid"
                                alt="Profile Icon">
                        </div>
                        <div class="d-flex flex-column gap-2 p-2">
                            <div class="row">
                                <h4 class="username text-center">{{ Auth::user()->name }}</h4>
                            </div>
                            <div class="row">
                                <button class="btn btn-success" id="btn-mudarAvatar">Mudar ícone</button>
                            </div>
                            @if (Auth::user()->auth_type == 'email')
                                <div class="row">
                                    <button class="btn btn-danger" id="btn-alterarSenha">Alterar Senha</button>
                                </div>
                                <div class="row" id="info-message"></div>
                            @else
                                <div class="row">
                                    <div class="alert alert-warning">
                                        Como você entrou com o {{ Auth::user()->auth_type }} você pode atualizar sua senha por
                                        <a href="/forgot-password" class="link-share">aqui</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal ícones --}}
    <div class="modal fade vh-50" id="iconesModal" tabindex="-1" aria-labelledby="staticiconesModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="iconesModalLabel">Escolha um novo ícone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="icone-container">
                    {{-- Os ícones são geradas aqui --}}
                    <div class="container">
                        <div class="col-md-12 d-flex justify-content-center flex-wrap gap-2">
                            @foreach ($data as $profileIcon)
                                <div class="col-3 col-md-2 rounded-circle icon {{ $profileIcon->id === Auth::user()->profile_icon ? 'border border-dark' : '' }}"
                                    data-profile_icon={{ $profileIcon->id }}>
                                    <img src="/img/profile_icons/{{ $profileIcon->nm_icon }}"
                                        alt="Profile Icon {{ $profileIcon->id }}" class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btn-atualizarIcone"
                        data-userid="{{ auth()->user()->id }}">Atualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Alterar Senha --}}
    <div class="modal fade vh-50" id="alterarSenhaModal" tabindex="-1" aria-labelledby="staticalterarSenhaModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alterarSenhaModalLabel">Alterar senha</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <label class="form-label" for="password">Senha Atual</label>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Digite sua senha atual" minlength="8" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="password">Nova senha</label>
                        <input type="password" id="new-password" name="new-password" class="form-control"
                            placeholder="Digite sua nova senha" minlength="8" />
                    </div>
                    <div class="col-md-12" id="informacao"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btn-confirmarSenha"
                        data-userid="{{ auth()->user()->id }}">Alterar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-script')
    {{-- Métricas JS --}}
    <script type="text/javascript" src="/js/funcoesPerfil.js"></script>
@endsection
