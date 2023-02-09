$("#btn-mudarAvatar").on("click", function () {
    $("#iconesModal").modal("show");
});

$(".icon").on("click", function (e) {
    if ($(".border.border-dark").length) {
        $(".border.border-dark").removeClass("border border-dark");
    }

    $(this).addClass("border border-dark");
});

$("#btn-atualizarIcone").on("click", function () {
    let user_id = $(this).attr("data-userid");
    let update_icon = $(".border.border-dark").attr("data-profile_icon");
    let update_icon_url = $(".border.border-dark").find("img").attr("src");
    let atualizarIconeApi = `${window.location.origin}/api/atualizaricone`;

    let data = {
        method: "PUT",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            user_id: user_id,
            profile_icon: update_icon,
        }),
    };

    fetch(atualizarIconeApi, data)
        .then((req) => req.json())
        .then((body) => {
            $("#profile-icon, #nav-profile-icon").attr("src", update_icon_url);
            $("#iconesModal").modal("hide");
            $("#info-message")
                .hide()
                .html(
                    `<div class='alert alert-success mt-2'>${body.message}</div>`
                )
                .fadeIn("slow");

            setTimeout(function () {
                $("#info-message").fadeOut("slow");
            }, 3000);
        })
        .catch((error) => error);
});

$("#btn-alterarSenha").on("click", function () {
    $("#alterarSenhaModal").modal("show");
});

$("#alterarSenhaModal").on("hide.bs.modal", function () {
    $("#alterarSenhaModal input").val("");
    $("#informacao").html("");
});

$("#btn-confirmarSenha").on("click", function () {
    let user_id = $(this).attr("data-userid");
    let password = $("#password").val();
    let new_password = $("#new-password").val();
    let alterarSenhaApi = `${window.location.origin}/api/alterarsenha`;

    if (password.length >= 8 && new_password.length >= 8) {
        let data = {
            method: "PUT",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                user_id: user_id,
                password: password,
                new_password: new_password,
            }),
        };

        fetch(alterarSenhaApi, data)
            .then((req) => req.json())
            .then((body) => {
                if (body.status == 406) {
                    $("#informacao")
                        .hide()
                        .html(
                            "<div class='alert alert-danger mt-2'>A senha atual não está correta</div>"
                        )
                        .fadeIn();
                    $("#password").val("");
                    $("#password").focus();
                } else {
                    $("#alterarSenhaModal").modal("hide");

                    $("#info-message")
                        .hide()
                        .html(
                            `<div class='alert alert-success mt-2'>${body.message}</div>`
                        )
                        .fadeIn("slow");

                    setTimeout(function () {
                        $("#info-message").fadeOut("slow");
                    }, 3000);
                }
            });
    } else {
        alert("As senhas devem possuir no mínimo 8 caracteres");
    }
});
