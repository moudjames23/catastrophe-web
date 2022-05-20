<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
    <script
        src='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
    <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
    <style>
        html, body {
            height: 100%;
            padding: 0;
            margin: 0;
        }

        #map {
            /* configure the size of the map */
            width: 100%;
            height: 100%;
            z-index: 10;
        }


        #legend {
            position: fixed;
            left: 0px;
            bottom: 0px;
            margin-left: 15px;
            margin-bottom: 15px;
            height: 250px !important;
            width: 250px !important;
            z-index: 99 !important;
        }
    </style>
</head>
<body>

<input type="hidden" value="@json($layers)" id="data">

<div id="map"></div>
    <div class="div-legend">

    </div>

{{--<script>

    // initialize Leaflet
    var map = L.map('map').setView({lon: -11.283844999999985, lat: 9.934886500000001}, 7);

    // add the OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    // show the scale bar on the lower left corner
    L.control.scale().addTo(map);

    --}}{{--var file =  '{{ public_path('/kml/KML-62384db0a926a.kml') }}';--}}{{--


    var layers = {!! json_encode($layers) !!}


    var dataTrack;

    for ( i = 0; i < layers.length; i++)
    {
        var file =  'kml/'  +layers[i]['url'];




        fetch(file)
            .then(res => res.text())
            .then(kmltext => {
                // Create new kml overlay
                const track = new omnivore.kml.parse(kmltext);
                map.addLayer(track);

                // Adjust map to show the kml
                const bounds = track.getBounds();
                map.fitBounds(bounds);
            }).catch((e) => {
            console.log(e);
        })
    }



    // Google Map Layer

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });
    googleStreets.addTo(map);

    // Satelite Layer
    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });
    googleSat.addTo(map);

    var baseLayers = {
        "Satellite":googleSat,
        "Google Map":googleStreets,
    };


    const overlayers = {

    }

    L.control.layers(baseLayers, overlayers).addTo(map);





</script>--}}

<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js">

</script>
<script>
    var map = L.map('map', {
        preferCanvas: true // recommended when loading large layers.
    });
    map.setView(new L.LatLng(9.934886500000001, -11.283844999999985), 7);

    var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 17,
        attribution: 'Map data: &copy; <a href="http://www.openstreetmap.org/copyright"></a> <a href="http://viewfinderpanoramas.org"></a> | Map style: &copy; <a href="https://opentopomap.org"></a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/"></a>)',
        opacity: 0.90
    });
    OpenTopoMap.addTo(map);


    // Instantiate KMZ layer (async)
    var kmz = L.kmzLayer().addTo(map);

    kmz.on('load', function (e) {
        control.addOverlay(e.layer, e.name);
        e.layer.addTo(map);
    });

    var layers =
        {!! json_encode($layers) !!}

    for (i = 0; i < layers.length; i++) {
        kmz.load('kml/' + layers[i]['url']);

        console.log("Image: legende/" +layers[i]['legende'])
    }


    // Google Map Layer

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleStreets.addTo(map);

    // Satelite Layer
    googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleSat.addTo(map);

    var baseLayers = {
        "Satellite": googleSat,
        "Google Map": googleStreets,
    };


    const overlayers = {}


    L.control.layers(baseLayers, overlayers)
        .addTo(map);

    var legend = L.control({
        position: 'bottomleft'
    });

    //legend.addTo(map);

    // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)


    var control = L.control.layers(null, null, {collapsed: true})
        .addTo(map);

    map.on('overlayadd', function (e) {
       updateLegende(e.name)
    });

    function updateLegende(nom)
    {
        var url = "{{ url("/")  }}/get-legend/" +nom;
        console.log('Url: ' +url)

        $.ajax({
            url: url,
            type: 'GET',
            success: function(res) {
                console.log('success');

                $('.div-legend').html(res)

            },
            error: function () {
                console.log('crève');
            }
        });
    }


    /* var legend = L.control({position: 'bottomleft'});

     legend.onAdd = function (map) {

         var div = L.DomUtil.create('div', 'info legend'),
             grades = [0, 10, 20, 50, 100, 200, 500, 1000],
             labels = [];

         // loop through our density intervals and generate a label with a colored square for each interval
         for (var i = 0; i < grades.length; i++) {
             div.innerHTML +=
                 '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                 grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
         }

         return div;
     };

     legend.addTo(map);


     function getColor(d) {
         return d > 1000 ? '#800026' :
             d > 500  ? '#BD0026' :
                 d > 200  ? '#E31A1C' :
                     d > 100  ? '#FC4E2A' :
                         d > 50   ? '#FD8D3C' :
                             d > 20   ? '#FEB24C' :
                                 d > 10   ? '#FED976' :
                                     '#FFEDA0';
     }*/
</script>

</body>
</html>
