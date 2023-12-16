<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= base_url('awesome-marker/dist/leaflet.awesome-markers.css') ?>">
    <!-- Routing Machine -->
    <link rel="stylesheet" href="<?= base_url('leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.css') ?>">
    <link rel="stylesheet" href="index.css"   />
    <!-- Geolocation CSS Library for Plugin -->
    <link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css">
    <!-- Leaflet Mouse Position CSS Library -->
    <link rel="stylesheet" href="<?= base_url('plugins/leaflet-mouseposition/L.Control.MousePosition.css') ?>">

    <style>
        #map {
            height: calc(100vh - 50px);
            width: 100%;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-sharp fa-solid fa-location-dot"></i>Find Hospital</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">


                    <?php if (auth()->loggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?= base_url('home/beranda') ?>"><i class="fa-solid fa-house"></i>Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?= base_url('home/input') ?>"><i class="fa-solid fa-circle-plus"></i>Input</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/tabel') ?>"><i class="fa-solid fa-table"></i>Tabel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i class="fa-solid fa-map-location-dot"></i>Peta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fa-solid fa-circle-user"></i>Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-map-location-dot"></i>Peta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="<?= base_url('login') ?>"><i class="fa-solid fa-right-to-bracket"></i>Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <div class="card">
        <div id="map"></div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-circle-user"></i>Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Username</th>
                            <td><?= auth()->user()->username ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= auth()->user()->email ?></td>
                        </tr>
                        <tr>
                            <th>Registered at</th>
                            <td><?= auth()->user()->created_at ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-hash/0.2.1/leaflet-hash.min.js"></script>
    <script src="<?= base_url('awesome-marker/dist/leaflet.awesome-markers.js') ?>"></script>
    <!-- Routing Machine -->
    <script src="<?= base_url('leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.js') ?>"></script>
    <script src="<?= base_url('leaflet-routing-machine-3.2.12/examples/Control.Geocoder.js') ?>"></script>
    <!-- Geolocation Javascript Library -->
    <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js"></script>
    <!-- Leaflet Mouse Position JavaScript Library -->
    <script src="<?= base_url('plugins/leaflet-mouseposition/L.Control.MousePosition.js') ?>"></script>
    <script src="config.js"></script>
    <script>
        /* Initial Map */
        let center = [-7.794850310886298, 110.36711900395542];
        let map = L.map('map').setView(center, 10); //lat, long, zoom
        map.scrollWheelZoom.disable(); //disable zoom with scroll

        /* Tile Basemap */
        let basemap = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: 'Google Satellite | <a href="https://unsorry.net" target="_blank">unsorry@2020</a>'
        });
        basemap.addTo(map);

        /* Display zoom, latitude, longitude in URL */
        let hash = new L.Hash(map);

        /* GeoJSON Point */
        var point = L.geoJson(null, {

            pointToLayer: function(feature, latlng) {
                var marker = L.marker(latlng, {
                    icon: L.AwesomeMarkers.icon({
                        icon: 'globe',
                        stylePrefix: 'fas',
                        prefix: 'fa',
                        markerColor: 'green',
                        iconColor: 'white'
                    })
                });
                return marker;
            },

            onEachFeature: function(feature, layer) {
                var popupContent = "Nama: " + feature.properties.nama + "<br>" +
                    "Deskripsi: " + feature.properties.deskripsi + "<br>" + "<img src='../upload/foto/" + feature.properties.foto + "' height='90px'width='80%' >";
                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.nama);
                    },
                });
            },
        });
        $.getJSON("<?= base_url('api') ?>", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        /* Routing */
        L.Routing.control({
            waypoints: [
                L.latLng(-7.774504456465115, 110.37453422596805),
                L.latLng(-7.742740302929001, 110.35036099532878)
            ]
        }).addTo(map);

        /* Routing Machine */
        var geocoder = L.Control.Geocoder.nominatim();

        var control = L.Routing.control(L.extend({
            position: 'bottomright',
            waypoints: [null],
            geocoder: geocoder,
            routeWhileDragging: true,
            reverseWaypoints: true,
            showAlternatives: true,
            altLineOptions: {
                styles: [{
                        color: 'black',
                        opacity: 0.15,
                        weight: 9
                    },
                    {
                        color: 'white',
                        opacity: 0.8,
                        weight: 6
                    },
                    {
                        color: 'blue',
                        opacity: 0.5,
                        weight: 2
                    }
                ]
            }
        })).addTo(map);

        L.Routing.errorControl(control).addTo(map);

        /*Plugin Geolocation */
        var locateControl = L.control.locate({
            position: "topleft",
            drawCircle: true,
            follow: true,
            setView: true,
            keepCurrentZoomLevel: false,
            markerStyle: {
            weight: 1,
            opacity: 0.8,
            fillOpacity: 0.8,
            },
            circleStyle: {
                weight: 1,
                clickable: false,
            },
            icon: "fas fa-crosshairs",

            metric: true,
            strings: {
            title: "Click for Your Location",
            popup: "You're here. Accuracy {distance} {unit}",
            outsideMapBoundsMsg: "Not available"
            },
            locateOptions: {
            maxZoom: 16,
            watch: true,
            enableHighAccuracy: true,
            maximumAge: 10000,
            timeout: 10000
            },
        }).addTo(map);

        /*Plugin Mouse Position Coordinate */
        L.control.mousePosition({position:'bottomleft',
        separator: ',',
        prefix: 'Koordinat : '
        }).addTo(map);
    </script>
</body>

</html>