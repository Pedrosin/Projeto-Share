@extends('layouts.dash_template')
@section('title','Dados de recebimento')
@section('content')

@if ( session()->has('success') )
<p class="alert alert-success">{{ session('success') }}</p>
@endif

<div class="card text-dark bg-light mb-3 shadow-sm">
    <div class="card-header">
        <h5>Formas de recebimento</h5>
    </div>
    <div class="card-body">
        <nav>
            <div class="nav nav-pills" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-endereco-tab" data-bs-toggle="tab" data-bs-target="#nav-endereco" type="button" role="tab" aria-controls="nav-endereco" aria-selected="true">Endereço</button>
                <button class="nav-link" id="nav-pix-tab" data-bs-toggle="tab" data-bs-target="#nav-pix" type="button" role="tab" aria-controls="nav-pix" aria-selected="false">Chaves Pix</button>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-endereco" role="tabpanel" aria-labelledby="nav-endereco-tab">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <p class="card-text">Preencha todos os campos obrigatórios <span class="required"> *</span></p>
                        </div>
                        <form action="/atualizar-dados-projeto" method="POST" id="form-atualizar-projeto">
                            @csrf
                            <div class="col-md-12 row g-3">
                                <div class="col-md-3">
                                    <label for="cep" class="form-label">CEP<span class="required"> *</span></label>
                                    <input type="text" class="form-control cep" id="cep" name="cep" value="{{ auth()->user()->cep }}" placeholder="Digite seu CEP">
                                    @error('cep')
                                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="cidade" class="form-label">Cidade<span class="required"> *</span></label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ auth()->user()->cidade }}" placeholder="Cidade">
                                    @error('cidade')
                                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="uf" class="form-label">Estado<span class="required"> *</span></label>
                                    <select class="form-select custom-uf" name="uf" id="uf" value="{{ auth()->user()->uf }}"></select>
                                    @error('uf')
                                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="rua" class="form-label">Rua<span class="required"> *</span></label>
                                    <input type="text" class="form-control" id="rua" name="rua" value="{{ auth()->user()->rua }}" placeholder="Rua">
                                    @error('rua')
                                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="bairro" class="form-label">Bairro<span class="required"> *</span></label>
                                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{ auth()->user()->bairro }}" placeholder="Bairro">
                                    @error('bairro')
                                    <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="complemento" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" id="complemento" name="complemento" value="{{ auth()->user()->complemento }}" placeholder="Complemento">
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-share" type="submit">Atualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-pix" role="tabpanel" aria-labelledby="nav-pix-tab">
                <div class="tab-pane fade show active" id="nav-pix" role="tabpanel" aria-labelledby="nav-pix-tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <h4>Registrar chave pix</h4>
                                    <form action="/criar-pix" method="POST" id="form-cadastrar-pix">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <p>Qual chave Pix deseja cadastrar?</p>
                                                <div class="form-check">
                                                    <input type="radio" name="tipo_chave" id="tipo_celular" class="form-check-input" value="Celular">
                                                    <label for="tipo_celular" class="form-check-label">Celular</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="tipo_chave" id="tipo_cpf" class="form-check-input" value="CPF">
                                                    <label for="tipo_cpf" class="form-check-label">CPF</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="tipo_chave" id="tipo_cnpj" class="form-check-input" value="CNPJ">
                                                    <label for="tipo_cnpj" class="form-check-label">CNPJ</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="tipo_chave" id="tipo_email" class="form-check-input" value="E-mail">
                                                    <label for="tipo_email" class="form-check-label">E-mail</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" name="tipo_chave" id="tipo_aleatoria" class="form-check-input" value="Aleatória">
                                                    <label for="tipo_aleatoria" class="form-check-label">Chave Aleatória</label>
                                                </div>
                                                @error('')
                                                <p class="text-danger text-xs-mt-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="chave_pix" id="chave_pix" class="form-control" placeholder="Digite o valor da sua chave">
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-share" type="submit">Cadastrar Chave</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h4>Chaves registradas</h4>
                                    <div class="table-responsive">
                                        <table id="chaves-registradas" class="table table-striped" style="width: 100%;">
                                            <thead>
                                                <th>Tipo</th>
                                                <th>Valor</th>
                                                <th>Ativo</th>
                                                <th>Ações</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $chave)
                                                <tr>
                                                    <td>{{ $chave->tp_chave  }}</td>
                                                    <td>{{ $chave->valor  }}</td>
                                                    @if( $chave->ativo == 1)
                                                    <td>Sim</td>
                                                    @else
                                                    <td>Não</td>
                                                    @endif
                                                    <td>
                                                        @if( $chave->ativo == 1 )
                                                        <a href="desativar-chave/{{ $chave->id }}" class="text-decoration-none link-danger">
                                                            <i class="bi bi-x-circle" title="Desativar chave"></i>
                                                        </a>
                                                        @else
                                                        <a href="ativar-chave/{{ $chave->id }}" class="text-decoration-none link-success">
                                                            <i class="bi bi-lightning-charge" title="Ativar chave"></i>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="toastAlert" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="bi bi-bell-fill me-2 text-danger"></i>
                    <strong class="me-auto">Aviso</strong>
                    <small>Agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    É necessário selecionar o tipo da chave
                </div>
            </div>
        </div>

    </div>
</div>
@endsection