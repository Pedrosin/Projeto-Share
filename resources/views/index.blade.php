@extends('layouts.template')
@section('title','Projeto Share')
@section('content')

<section>
    <div class="fluid-container" id="introducao">
        <div class="d-flex align-items-center" id="main-background">
            <div class="container text-light d-flex justify-content-start">
                <div class="col-md-6 p-lg-6 my-6">
                    <h2 class="display-2">Seja bem vindo a</h2>
                    <h1 class="display-1 fw-normal">Share</h1>
                    <p class="lead fw-normal">Onde todos participam da verdadeira adrenalina de mudar o mundo</p>
                    <a class="btn btn-share btn-lg" href="explorar">Explorar</a>
                </div>
            </div>
        </div>
        <div id="conteudo-disponivel" class="d-flex justify-content-center w-100">
            <a href="#info">
                <i class="bi bi-chevron-double-down" id="header-arrow"></i>
            </a>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid bg-share bg-gradient" id="info">
        <div class="row">
            <h2 class="text-center pt-5 text-light">Nossa missão</h2>
        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 text-center text-light pb-2">
                    <img src="/img/simplificar.jpg" alt="" class="rounded-circle img-fluid w-50 m-3">
                    <h3>Simplificar</h3>
                    <p>Simplificamos o processo de doação para nossos usuários, pensando em tornar esse gesto rápido e fácil.</p>
                </div>
                <div class="col-lg-4 text-center text-light pb-2">
                    <img src="/img/compartilhar.jpg" alt="" class="rounded-circle img-fluid w-50 m-3">
                    <h3>Compartilhar</h3>
                    <p>Ajudamos a compartilhar campanhas e facilitamos que elas sejam encontradas em sites de pesquisa.</p>
                </div>
                <div class="col-lg-4 text-center text-light pb-2">
                    <img src="/img/uniao.jpg" alt="" class="rounded-circle img-fluid w-50 m-3">
                    <h3>Unir</h3>
                    <p>Tornamos a share um <strong>ecossistema</strong> que reuni todos os projetos em um único lugar.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <h2 class="text-center pt-5">Juntos podemos gerar felicidade</h2>
        </div>
        <div class="card mt-5">
            <div class="row g-0">
                <div class="col-lg-7">
                    <img src="/img/alimentacao.jpg" class="img-fluid rounded-start" alt="Alimentação">
                </div>
                <div class="col-lg-5 d-flex align-items-center bg-share text-light">
                    <div class="card-body">
                        <h3 class="card-title">Alimentação</h3>
                        <p class="card-text">Milhares de famílias em nossa cidade não tem acesso à uma alimentação básica e complementar, e nós acreditamos que com o apoio de toda comunidade da <strong>Share</strong> vamos conseguir ajudar essas famílias.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="card">
            <div class="row g-0">
                <div class="col-lg-7 order-lg-2">
                    <img src="/img/saude.jpg" class="img-fluid rounded-end" alt="Saúde">
                </div>
                <div class="col-lg-5 d-flex align-items-center bg-share text-light order-lg-1">
                    <div class="card-body">
                        <h3 class="card-title">Saúde</h3>
                        <p class="card-text">Seja saúde física ou mental, a nossa plataforma estará disponível para receber ajuda voluntária de profissionais da saúde em campanhas de saúde.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-5">
        <div class="card mb-5">
            <div class="row g-0">
                <div class="col-lg-7">
                    <img src="/img/educacao.jpg" class="img-fluid rounded-start" alt="Educação">
                </div>
                <div class="col-lg-5 d-flex align-items-center bg-share text-light">
                    <div class="card-body">
                        <h3 class="card-title">Educação</h3>
                        <p class="card-text">Acreditamos que a educação seja um dos princípios mais importantes para combatermos várias dessas necessidades. Pensando neste motivo disponibilizamos campanhas que podem receber doações de livros, materiais escolares e cursos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="fluid-container">
    <div class="d-flex align-items-center" id="quote-background">
        <div class="container text-light d-flex justify-content-center">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p>A verdadeira caridade só ocorre quando não há a noção de dar, de doador ou de doação.</p>
                </blockquote>
                <figcaption class="blockquote-footer text-light">
                    Buda
                </figcaption>
            </figure>
        </div>
    </div>
</div>
</section>
<section class="container">
    <h2 class="text-center py-5">Como sua doação pode ajudar?</h2>
    <div class="doacao-slider">
        <div class="carousel-cell">
            <div class="card" style="width: 18rem;">
                <img src="/img/fome.jpg" class="card-img-top" alt="Fome">
                <div class="card-body bg-share text-light">
                    <h5 class="card-title">Fome</h5>
                    <p class="card-text">Com a sua doação os projetos sociais poderão ajudar milhares de famílias combatendo a fome em nossa cidade.</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem;">
                <img src="/img/bem-estar.jpg" class="card-img-top" alt="Dor">
                <div class="card-body bg-share text-light">
                    <h5 class="card-title">Bem-estar</h5>
                    <p class="card-text">Em campanhas de saúde, profissionais da área podem contribuir para ajudar a todos que realmente precisam.</p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem;">
                <img src="/img/estudos.jpg" class="card-img-top" alt="Estudos">
                <div class="card-body bg-share text-light">
                    <h5 class="card-title">Estudos</h5>
                    <p class="card-text">Seja pela doação de materiais escolares, cursos e palestras voluntárias, vamos impactar nos estudos e educação de todos.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<section>
    <div class="container-fluid bg-dark bg-gradient">
        <div class="row">
            <h2 class="text-center pt-5 text-light">Projetos que ajudam a mudar o mundo</h2>
        </div>
        <div class="container">
            <div class="row parceiros-container d-flex justify-content-center align-items-center">
                <div class="col-sm-6 col-md-6 col-lg-3 col-12 text-center p-3">
                    <img src="/img/parceiro.png" alt="" class="img-fluid w-50">
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-12 text-center p-3">
                    <img src="/img/parceiro.png" alt="" class="img-fluid w-50">
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3 col-12 text-center p-3">
                    <img src="/img/parceiro.png" alt="" class="img-fluid w-50">
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container py-5">
        <h2 class="text-center pb-5">Perguntas Frequentes</h2>
        <div class="d-flex flex-column justify-content-center">
            <div class="accordion accordion" id="accordionFaq">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta_1">
                            Como posso contribuir?
                        </button>
                    </h2>
                    <div id="pergunta_1" class="accordion-collapse collapse show" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">Para fazer uma doação, basta clica na opção <a href="/explorar" class="link-share">Explorar</a>, escolher um projeto no <strong>mapa</strong>, depois escolher uma campanha e contribuir com a forma disponível.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta_2">
                            Como saberei se o projeto que estou ajudando é verídico?
                        </button>
                    </h2>
                    <div id="pergunta_2" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Não se preocupe, todos os projetos que estão aqui na <strong>Share</strong> foram devidamente analisados pela nossa equipe.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta_3">
                            O que faço depois de uma doação?
                        </button>
                    </h2>
                    <div id="pergunta_3" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Depois de uma doação, vamos criar uma ordem de doação e você poderá o status dela na opção <strong>minhas doações</strong>.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pergunta_4">
                            Posso ajudar a plataforma de alguma forma?
                        </button>
                    </h2>
                    <div id="pergunta_4" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            Sim. Você pode fazer uma doação de forma simbólica para o nosso projeto. É só acessar a opção <strong>apoie-nos</strong> para mais detalhes.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <h2 class="text-center">Nossos números</h2>
        <div class="numeros-container d-flex flex-column justify-content-center">
            <div class="row">
                <div class="col-lg-3 col-6 item-number">
                    <img src="/img/icons/donation.png" class="card-img-top" alt="...">
                    <h3 class="item-value pt-2">200</h3>
                    <p class="item-title text-center">Cestas básicas</p>
                </div>
                <div class="col-lg-3 col-6 item-number">
                    <img src="/img/icons/lunch.png" class="card-img-top" alt="...">
                    <h3 class="item-value pt-2">3000</h3>
                    <p class="item-title text-center">Refeições</p>
                </div>
                <div class="col-lg-3 col-6 item-number">
                    <img src="/img/icons/people.png" class="card-img-top" alt="...">
                    <h3 class="item-value pt-2">200</h3>
                    <p class="item-title text-center">Famílias ajudadas</p>
                </div>
                <div class="col-lg-3 col-6 item-number">
                    <img src="/img/icons/united.png" class="card-img-top" alt="...">
                    <h3 class="item-value pt-2">1300</h3>
                    <p class="item-title text-center">Usuários</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection