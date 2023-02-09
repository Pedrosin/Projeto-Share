// Chave para acessar os serviços do Mapbox
const mapboxApiKey = document
    .getElementsByName("mapbox_api_key")[0]
    .getAttribute("content");

// Função responsável por criar o mapa e toda a interatividade
function construirMapa(projetos) {
    mapboxgl.accessToken = mapboxApiKey;

    /**
     * Cria instância do mapa e inicia com nosso estilo personalizado
     * Defini a posição central do mapa e o zoom
     */
    const map = new mapboxgl.Map({
        container: "map",
        style: "mapbox://styles/lucashayashi/cl729ryb9000714n1j3k69z7q",
        center: [-49.06889, -22.32537],
        zoom: 13,
    });

    map.on("load", () => {
        map.addSource("places", {
            type: "geojson",
            data: projetos,
        });

        criaListaDeLocalizacao(projetos);
        adicionaMarcas();
    });

    function adicionaMarcas() {
        // Para cada lista de projetos dentro do objeto projeto
        for (const marker of projetos.features) {
            // Cria uma div para a marca
            const el = document.createElement("div");
            // Atribui um id único para cada marca
            el.id = `marker-${marker.properties.id}`;
            // Atribui a classe marker para estilização
            el.className = "marker";
            // Cria uma marca com a div criada, e posiciona nas coodernadas do projeto
            new mapboxgl.Marker(el, {
                offset: [0, -23],
            })
                .setLngLat(marker.geometry.coordinates)
                .addTo(map);

            el.addEventListener("click", (e) => {
                /* Fly to the point */
                voarParaProjeto(marker);
                /* Close all other popups and display popup for clicked store */
                criarPopUp(marker);
                /* Highlight listing in sidebar */
                const activeItem = document.getElementsByClassName("active");
                e.stopPropagation();
                if (activeItem[0]) {
                    activeItem[0].classList.remove("active");
                }
                const listing = document.getElementById(
                    `listing-${marker.properties.id}`
                );
                listing.classList.add("active");
            });
        }
    }

    // Adiciona cada projeto na sidebar
    function criaListaDeLocalizacao(projetos) {
        // seleciona o elemento listings que irá receber os projetos
        const listings = document.getElementById("listings");

        const listingsInfo = listings.appendChild(
            document.createElement("div")
        );

        listingsInfo.className = "item";

        const infoTitle = listingsInfo.appendChild(
            document.createElement("h5")
        );
        infoTitle.className = "info-item";
        infoTitle.innerHTML = "Selecione um projeto";

        for (const store of projetos.features) {
            const listing = listings.appendChild(document.createElement("div"));
            // Atribui um id único para cada item da lista
            listing.id = `listing-${store.properties.id}`;
            // Atribui a classe item para estilização
            listing.className = "item";

            // Cria um link personalizado para cada item da lista
            const link = listing.appendChild(document.createElement("a"));
            link.href = "#";
            link.className = "title";
            link.id = `link-${store.properties.id}`;
            link.innerHTML = `${store.properties.name}`;

            const name = listing.appendChild(document.createElement("div"));
            name.innerHTML = `${store.properties.rua}`;

            // Adiciona os detalhes do projeto em cada item da lista
            const details = listing.appendChild(document.createElement("div"));
            details.innerHTML = `${store.properties.cidade}`;
            details.innerHTML += ` · ${store.properties.cep}`;

            link.addEventListener("click", function (e) {
                e.preventDefault();
                for (const feature of projetos.features) {
                    if (this.id === `link-${feature.properties.id}`) {
                        voarParaProjeto(feature);
                        criarPopUp(feature);
                    }
                }
                const activeItem = document.getElementsByClassName("active");
                if (activeItem[0]) {
                    activeItem[0].classList.remove("active");
                }
                this.parentNode.classList.add("active");
            });
        }
    }

    /**
     * Função responsável por voar para uma localização quando
     * houver o evento de clique na marca ou na lista do projeto
     */
    function voarParaProjeto(currentFeature) {
        // A função 'flyTo' move a camera do mapa suavemente para o centro do ponto
        map.flyTo({
            center: currentFeature.geometry.coordinates,
            zoom: 15,
        });
    }

    /**
     * Função responsável por criar um popup quando
     * houver o evento de clique na marca ou na lista do projeto
     */
    function criarPopUp(currentFeature) {
        const popUps = document.getElementsByClassName("mapboxgl-popup");
        if (popUps[0]) popUps[0].remove();

        let { id, name, rua, bairro, cidade, uf, celular, email } =
            currentFeature.properties;

        // A função 'Popup' cria um popup de acordo com o elemento html criado
        const popup = new mapboxgl.Popup({
            closeOnClick: false,
        })
            .setLngLat(currentFeature.geometry.coordinates)
            .setHTML(
                `<h3>${name}</h3>
                    <ul>
                        <li>${rua}, ${bairro}, ${cidade}, ${uf}</li>
                        <li>Celular: ${celular}</li>
                        <li>E-mail: ${email}</li>
                        <li><button class="btn btn-share mt-3" onclick="carregaPublicacao(${id}, '${name}')">Ver publicações</button></li>
                    </ul>`
            )
            .addTo(map);
    }
}
function serialize(obj) {
    let str =
        "?" +
        Object.keys(obj)
            .reduce(function (a, k) {
                a.push(k + "=" + encodeURIComponent(obj[k]));
                return a;
            }, [])
            .join("&");
    return str;
}
/**
 * Cria um objeto com todos os dados dos projetos disponíveis para criar o mapa
 */
async function pegaCoordenadas() {
    const apiEnderecosProjetos = `${window.location.origin}/api/endereco`; // Url com o endpoint api/endereço
    const responseProjetos = await fetch(apiEnderecosProjetos); // Faz a requisição para o endpoint
    const contentProjetos = await responseProjetos.json(); // Pega os dados de retorno em JSON e transforma em um objeto

    let informacoesDosProjetos = new Array(); // Variável que armazena todos vetores com informações dos projetos

    for (key in contentProjetos) {
        /**
         * Faz a desestruturação do objeto de cada objeto de retorno da API
         * encurtando a forma que as variáveis seriam utilizadas no código
         * Exemplo: contentProjetos[key].name para name
         */
        const { id, name, email, celular, cep, rua, bairro, cidade, uf } =
            contentProjetos[key];

        let search_text = rua + " " + cidade;
        let query = {
            records: [
                {
                    attributes: {
                        OBJECTID: id,
                        Address: rua,
                        City: cidade,
                        Region: uf,
                        Postal: cep,
                    },
                },
            ],
        };

        // Url com o endpoint geocoding da mapbox
        const geocoding = `https://api.mapbox.com/geocoding/v5/mapbox.places/${search_text}.json?access_token=${mapboxApiKey}`;
        const response = await fetch(geocoding); // Faz a requisição para o endpoint
        const content = await response.json(); // Pega os dados de retorno em JSON e transforma em um objeto
        const coordArray = content.features[0].geometry.coordinates; // Armazena as coordenadas X e Y

        // Cria um objeto com informações personalizadas de cada projeto para ser usado na construção do mapa
        let feature = {
            type: "Feature",
            geometry: {
                type: "Point",
                coordinates: coordArray,
            },
            properties: {
                id: id,
                name: name,
                email: email,
                celular: celular,
                cep: cep,
                rua: rua,
                bairro: bairro,
                cidade: cidade,
                uf: uf,
            },
        };
        informacoesDosProjetos.push(feature);
    }

    // Cria um objeto final contendo um pacote com as informações de todos os projetos disponíveis
    const projetos = {
        type: "FeatureCollection",
        features: informacoesDosProjetos,
    };

    // Chama a função que cria o mapa, seta as coodernadas e cria os popups
    construirMapa(projetos);
}

pegaCoordenadas();
