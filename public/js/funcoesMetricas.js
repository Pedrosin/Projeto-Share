let myChart;

async function gerarMetricas(startDate, endDate, userId) {
    let data = {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            startDate: startDate.format("YYYY-MM-DD"),
            endDate: endDate.format("YYYY-MM-DD"),
            userId: userId,
        }),
    };

    let request = await fetch(
        `${window.location.origin}/api/metricas/totais`,
        data
    );

    if (request.ok) {
        let response = await request.json();
        let labels = await response.map((publicacao) => publicacao.titulo);
        let dados = await response.map((publicacao) =>
            parseInt(publicacao.nr_doacoes)
        );

        if (!myChart) {
            let ctx = document.getElementById("myChart").getContext("2d");

            let gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0.1, "rgba(218, 209, 237, 1)");
            gradient.addColorStop(1, "rgba(218, 209, 237, 0.2)");

            myChart = new Chart(ctx, {
                type: "bar",
                decimation: "false",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Total de doações por publicação ",
                            data: dados,
                            borderColor: "rgb(94, 54, 179)",
                            backgroundColor: gradient,
                            borderWidth: 2,
                            fill: {
                                target: "start",
                                above: gradient,
                            },
                            tension: 0.4,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            type: "linear",
                            grace: "5%",
                            beginAtZero: true,
                            grid: {
                                borderDash: [8, 4],
                                color: "#dfdfdf",
                            },
                            ticks: {
                                precision: 0,
                            },
                        },
                        x: {
                            grid: {
                                display: false,
                            },
                        },
                    },
                    layout: {
                        padding: 40,
                    },
                },
            });
        } else {
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = dados;
            myChart.update();
        }
    } else {
        let newDataSet = myChart.data.labels.map((label) => {
            return 0;
        });

        myChart.data.datasets[0].data = newDataSet;
        myChart.update();
    }
}

function cb(start, end) {
    let fmtStartDate = start.format("D MMM. YYYY");
    let fmtEndDate = end.format("D MMM. YYYY");
    let templateDate = fmtStartDate + " - " + fmtEndDate;
    let userId = $(".dashboard-header").attr("data-userid");

    $("#filtro-metrica-geral").val(templateDate);

    gerarMetricas(start, end, userId, myChart);
}

function gerarDocumento(tipo) {
    let startDate = $("#metricas-range")
        .data("daterangepicker")
        .startDate.format("YYYY-MM-DD");
    let endDate = $("#metricas-range")
        .data("daterangepicker")
        .endDate.format("YYYY-MM-DD");
    let userId = $(".dashboard-header").attr("data-userid");

    if (startDate && endDate && userId) {
        window.open(
            `${window.location.origin}/api/metricas/gerarExcel/${startDate}/${endDate}/${userId}/${tipo}`,
            "_blank"
        );
    } else {
        alert(
            "Não é possível gerar o arquivo, porque a data não está definida"
        );
    }
}

$(document).ready(function () {
    let start = moment().subtract(29, "days");
    let end = moment();

    moment.locale("pt-br");

    $("#metricas-range").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Hoje: [moment(), moment()],
                Ontem: [moment().subtract(1, "days")],
                "Últimos 7 dias": [moment().subtract(6, "days"), moment()],
                "Últimos 15 dias": [moment().subtract(14, "days"), moment()],
                "Últimos 30 dias": [moment().subtract(29, "days"), moment()],
                "Esse mês": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Mês passado": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
            locale: {
                format: "DD/MM/YYYY hh:mm A",
                separator: "~",
                applyLabel: "Confirmar",
                cancelLabel: "Cancelar",
                daysOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                monthNames: [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez",
                ],
                firstDay: 0,
                customRangeLabel: "Personalizado",
            },
        },
        cb
    );

    cb(start, end);

    $("#btnGerarExcel").on("click", function () {
        gerarDocumento("xlsx");
    });
    $("#btnGerarPdf").on("click", function () {
        gerarDocumento("pdf");
    });
    $("#btnGerarCsv").on("click", function () {
        gerarDocumento("csv");
    });
    $("#btnGerarHtml").on("click", function () {
        gerarDocumento("html");
    });
});
