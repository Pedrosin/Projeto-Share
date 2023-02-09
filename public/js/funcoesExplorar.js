async function carregaPublicacao(id_projeto, name) {
    const publicacoesApi = `${window.location.origin}/api/publicacoes/${id_projeto}`;
    const response = await fetch(publicacoesApi);
    const content = await response.json();

    if (response.ok) {
        let html = "";

        for (key in content) {
            let {
                id,
                id_usuario,
                id_tipo,
                titulo,
                descricao,
                dt_inicio,
                dt_fim,
                path_imagem,
            } = content[key];

            html += `<div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="${path_imagem}" class="img-fluid rounded-start" style="height:100%; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">${titulo}</h5>
                                <p class="card-text m-0">${descricao}</p>
                                <p class="card-text"><small class="text-muted">Início: ${dt_inicio} | Fim: ${dt_fim}</small></p>
                                <button class="btn btn-share" onclick="carregaDoacao(${id}, ${id_usuario}, ${id_tipo}, '${titulo}')" data-bs-dismiss="modal">Contribuir</button>
                            </div>
                            </div>
                        </div>
                    </div>`;
        }

        $(".nome_campanha").text(name);
        $("#conteudo").html(html);
        $("#publicacoesModal").modal("show");
    } else {
        html = `<div class="alert alert-danger">
                O projeto ainda não fez publicações
            </div>`;
            
        $(".titulo_aviso").text("Aviso");
        $("#conteudo_aviso").html(html);
        $("#avisoModal").modal("show");
    }
}

async function carregaDoacao(id, id_usuario, id_tipo, titulo) {
    const recebimentoApi = `${window.location.origin}/api/recebimento/${id_usuario}`;
    const response = await fetch(recebimentoApi);
    const content = await response.json();
    let html = "";
    if (content.pix[0]) {
        const { tp_chave, valor } = content.pix[0];
        let chavePixFormatada;
        if (tp_chave == "Celular") {
            chavePixFormatada = "+55" + valor.replace(/[^\d]+/g, "");
        } else if (tp_chave == "CPF" || tp_chave == "CNPJ") {
            chavePixFormatada = valor.replace(/[^\d]+/g, "");
        } else {
            chavePixFormatada = valor;
        }

        const { name, rua, bairro, cidade, uf, cep, celular } =
            content.usuario[0];
        const geraChavePixCode = `${window.location.origin}/api/gerarchavepix/${chavePixFormatada}/${name}/${cidade}`;
        const PixCodeResponse = await fetch(geraChavePixCode);
        const PixCodeContent = await PixCodeResponse.json();
        let fg_qrcode;

        html = `<div class="row g-2">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-body">`;

        switch (id_tipo) {
            case 1:
                fg_qrcode = true;
                html += `
                <p><b>Faça um Pix para chave ${tp_chave}:</b></p>
                <input class="form-control" type="text" value="${valor}" id="chave" readonly>
                <button type="button" class="btn btn-share my-3" id="chave_pix">Copiar Chave</button>
                <div id="qrcode"></div>`;
                break;
            case 2:
                html += `
                <p><b>Leve a sua doação até o endereço:</b></p>
                <p>${rua}, ${bairro}</p>
                <p>${cidade} - ${uf} - ${cep}</p>
                <p>Cel.: ${celular}</p>`;
                break;
            case 3:
                fg_qrcode = true;
                html += `
                <p><b>Faça um Pix para chave ${tp_chave}:</b></p>
                <input class="form-control" type="text" value="${valor}" id="chave" readonly>
                <button type="button" class="btn btn-share my-3" id="chave_pix" onclick="copiarChavePix(this)">Copiar Chave</button>
                <div id="qrcode"></div>
                <hr>
                <p><b>Ou leve a sua doação até o endereço:</b></p>
                <p>${rua}, ${bairro}</p>
                <p>${cidade} - ${uf} - ${cep}</p>
                <p>Cel.: ${celular}</p>`;
                break;
        }

        html += `</div> </div> </div> </div>`;

        $(".nome_projeto").text(titulo);
        $("#info-doacao").html(html);
        $("#criarOrdem").attr("data-publicacao", id);

        if (fg_qrcode) {
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: PixCodeContent.pix,
                width: 156,
                height: 156,
            });
        }

        $("#contribuirModal").modal("show");
    } else {
        html = `<div class="alert alert-danger">
                    O projeto ainda não ativou uma chave PIX para recebimento das doações, por favor tente mais tarde.
                </div>`;
        $(".titulo_aviso").text("Aviso");
        $("#conteudo_aviso").html(html);
        $("#avisoModal").modal("show");
    }
}

async function criarOrdemDoacao(id_usuario) {
    const salvarDoacaoApi = `${window.location.origin}/api/concluirdoacao`;
    const id_publicacao = $("#criarOrdem").attr("data-publicacao");
    const id_status = 1; // Pendente

    const params = {
        id_usuario: id_usuario,
        id_publicacao: id_publicacao,
        id_status: id_status,
    };

    const options = {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify(params),
    };

    const response = await fetch(salvarDoacaoApi, options);
    const content = await response.json();

    if (response.ok) {
        $(".modal").modal("hide");
        $("#confirmacaoModal").modal("show");
    } else {
        const html = `<div class="alert alert-danger">${content.message}</div>`;
        $("#conteudo_aviso").append(html);
        $("#avisoModal").modal("show");
    }
}

function copiarChavePix(element) {
    var copyText = $("#chave").val();

    navigator.clipboard.writeText(copyText).then(() => {
        $(element).notify("Chave copiada", {
            position: "right",
            className: "success",
        });
    });
}

$(document).ready(function () {
    let url = window.location.href.replace(/\#/g, "");

    if ($(" .navbar ").length) {
        $(".nav-link")
            .filter(function () {
                return this.href == url;
            })
            .addClass("active");
    }
});
