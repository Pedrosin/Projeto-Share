function limpa_formulário_cep() {
    $("#rua").val("");
    $("#complemento").val("");
    $("#bairro").val("");
    $("#cidade").val("");
    $("#uf").val("");
}

$(document).ready(function () {
    $("#cep").blur(function () {
        let cep = $(this).val().replace(/\D/g, "");

        if (cep != "") {
            let validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                $("#rua").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#complemento").val("...");
                $("#uf").val("...");

                $.getJSON(
                    "https://viacep.com.br/ws/" + cep + "/json/?callback=?",
                    function (dados) {
                        if (!("erro" in dados)) {
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#complemento").val(dados.complemento);
                            $("#uf").val(dados.uf);
                        } else {
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    }
                );
            } else {
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            limpa_formulário_cep();
        }
    });

    let SPMaskBehavior = function (val) {
            return val.replace(/\D/g, "").length === 11
                ? "(00) 00000-0000"
                : "(00) 0000-00009";
        },
        spOptions = {
            onKeyPress: function (val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            },
        };

    $(".sp_celphones").mask(SPMaskBehavior, spOptions);

    $(".cep").mask("00000-000");

    $(".data").mask("00/00/0000");

    if ($(".doacao-slider").length) {
        $(".doacao-slider").flickity({
            groupCells: true,
        });
    }

    // Faz a requisição apenas se existir input de estado
    if ($("#uf").length) {
        $.getJSON(
            "https://servicodados.ibge.gov.br/api/v1/localidades/estados/",
            function (data) {
                let select = $("#uf");
                let options = "<option selected>--Selecione--</option>";
                for (estado in data) {
                    options += `<option value="${data[estado].sigla}">${data[estado].nome}</option>`;
                }
                select.append(options);

                if ($(".custom-uf")) {
                    let valor = $(".custom-uf").attr("value");
                    $(".custom-uf").val(valor);
                }
            }
        );
    }

    let url = window.location.href.replace(/\#/g, "");

    if ($(" .sidebar ").length) {
        $('.nav-items li a[href="' + url + '"]')
            .parent()
            .addClass("active");
        $(".nav-items li a")
            .filter(function () {
                return this.href == url;
            })
            .parent()
            .addClass("active");
    }

    if ($(" .navbar ").length) {
        $(".nav-link")
            .filter(function () {
                return this.href == url
            })
            .addClass("active");
    }

    if ($(".table").length) {
        $(".table").DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json",
            },
            ordering: false,
        });
    }

    $("#chave_pix").on("click", function () {
        let chkTipo = $("[name=tipo_chave]");
        let toastAlert = $(" #toastAlert ");

        if (chkTipo.is(":checked")) {
            let tipo = chkTipo.closest(":checked").val();

            switch (tipo) {
                case "Celular":
                    $("#chave_pix").mask(SPMaskBehavior, spOptions);
                    break;
                case "CPF":
                    $("#chave_pix").mask("000.000.000-00", {
                        reverse: true,
                    });
                    break;
                case "CNPJ":
                    $("#chave_pix").mask("00.000.000/0000-00", {
                        reverse: true,
                    });
                    break;
                case "E-mail":
                    $("#chave_pix").mask("A", {
                        translation: {
                            A: { pattern: /[\w@\-.+]/, recursive: true },
                        },
                    });
                    "email";
                default:
                    break;
            }
        } else {
            $("#chave_pix").attr("disabled", true);
            let toast = new bootstrap.Toast(toastAlert);
            toast.show();
        }
    });

    $("[name=tipo_chave]").on("change", function () {
        if ($("#chave_pix")[0].hasAttribute("disabled")) {
            $("#chave_pix").attr("disabled", false);
        } else {
            $("#chave_pix").val("");
            $("#chave_pix").unmask();
        }
    });

    $(".carregarStatus").on("click", function (e) {
        e.preventDefault();
        let id_doacao = $(this).data("id");
        let id_situacao_atual = $(this).data("situacao");

        $("#situacao_status").attr("data-id", id_doacao);
        $("#situacao_status").val(id_situacao_atual);

        $("#atualizarStatusDoacaoModal").modal("show");
    });

    $("#btn-atualizar-status").on("click", function () {
        const btnAtualizar = $("#btn-atualizar-status");

        let formData = {
            id_status: $("#situacao_status").val(),
            id_doacao: $("#situacao_status").data("id"),
        };

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "/atualizar_doacao",
            method: "post",
            dataType: "json",
            data: formData,
            beforeSend: function () {
                $("#span-spinner").removeClass("d-none");
                $("#text-update").text("Atualizando...");
            },
            success: function (data) {
                setTimeout(function () {
                    $("#span-spinner").addClass("d-none");
                    $("#text-update").text("Atualizado");
                    location.reload();
                }, 1000);
            },
        });
    });
});
