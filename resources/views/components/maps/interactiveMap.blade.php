{{-- Empurra os estilos do Leaflet para o head --}}
@push('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />

@endpush

{{-- Conteúdo do componente do mapa aqui --}}


<div id="mapid" style="height: 600px;" class="mt-5"></div>




{{-- Empurra os scripts do Leaflet para o final do body --}}
@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin="">
         <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
</script>
<script>

    var streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    });

    var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    var cartoLight = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
        attribution: 'Map tiles by Carto, under CC BY 3.0. Data by OpenStreetMap, under ODbL.'
    });

    // Inicializa o mapa
    var map = L.map('mapid', {
        center: [54.5, -3.5], // Coordenadas aproximadas do centro do Reino Unido
        zoom: 6, // Ajuste conforme necessário para mostrar todo o Reino Unido na carga inicial
        minZoom: 5, // Impede o usuário de afastar demais e perder o foco no Reino Unido
        maxZoom: 17, // Limita o quão próximo o usuário pode aproximar
        layers: [streets] // Define streets como a camada padrão
    });

    // Configura as camadas de base
    var baseMaps = {
        "Streets": streets,
        "Satellite": satellite,
        'Light': cartoLight
    };

    // Adiciona o controle de camadas ao mapa
    L.control.layers(baseMaps).addTo(map);

    // // Inicializa o grupo de marcadores com clustering
    // var markers = L.markerClusterGroup();

    // // Adiciona marcadores ao grupo
    // var marker1 = L.marker([51.505, -0.09]).bindPopup("<b>Olá, mundo!</b><br>Eu sou um popup no mapa OpenStreetMap.");
    // var marker2 = L.marker([51.495, -0.083]).bindPopup("<b>Outro Ponto</b><br>Outro popup em Londres.");

    // markers.addLayer(marker1);
    // markers.addLayer(marker2);
    // // Adicione mais marcadores conforme necessário

    // // Adiciona o grupo de marcadores ao mapa
    // map.addLayer(markers);

    var customIcon = L.icon({
        iconUrl: '/assets/img/pin.png', // Substitua pelo caminho real da imagem
        iconSize: [50, 50], // Exemplo de tamanho, ajuste conforme necessário
        iconAnchor: [36, 36], // Ponto do ícone que corresponderá à localização do marcador no mapa
        popupAnchor: [-3, -76] // Ponto a partir do qual o popup deve abrir em relação ao iconAnchor
    });


    // document.addEventListener('DOMContentLoaded', function() {
    // var churchCards = document.querySelectorAll('.card-church-filtered');

    //     churchCards.forEach(function(card) {
    //         var latitude = card.getAttribute('data-latitude');
    //         var longitude = card.getAttribute('data-longitude');
    //         var name = card.querySelector('p:nth-child(1)').innerText; // Assume que o nome é o primeiro <p>
    //         var contact = card.querySelector('p:nth-child(2)').innerText; // Contact info
    //         var town = card.querySelector('p:nth-child(3)').innerText; // Town
    //         var county = card.querySelector('p:nth-child(4)').innerText; // County

    //         var marker = L.marker([latitude, longitude], {icon: customIcon}).addTo(map);
    //         marker.bindPopup('<b>' + name + '</b><br>' + contact + '<br>' + town + ', ' + county);
    //     });
    // });

    document.addEventListener('DOMContentLoaded', function() {
        var churchCards = document.querySelectorAll('.card-church-filtered');

        // Inicializa o grupo de marcadores com clustering
        var markers = L.markerClusterGroup();

        churchCards.forEach(function(card) {
            var latitude = card.getAttribute('data-latitude');
            var longitude = card.getAttribute('data-longitude');
            var name = card.querySelector('p:nth-child(1)').innerText; // Assume que o nome é o primeiro <p>
            var contact = card.querySelector('p:nth-child(2)').innerText; // Contact info
            var town = card.querySelector('p:nth-child(3)').innerText; // Town
            var county = card.querySelector('p:nth-child(4)').innerText; // County

            var marker = L.marker([parseFloat(latitude), parseFloat(longitude)], {icon: customIcon});
            marker.bindPopup('<b>' + name + '</b><br>' + contact + '<br>' + town + ', ' + county);

            // Adiciona o marcador ao grupo de marcadores com clustering
            markers.addLayer(marker);
        });

        // Adiciona o grupo de marcadores ao mapa
        map.addLayer(markers);
    });



</script>
@endpush
