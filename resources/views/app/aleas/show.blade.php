@extends('layouts.app')

@section('content')
    <div class="container">
       {{-- <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Carte interactive</h4>
                </div>


                <div id="map_alea" style="height: 50vh; width: 100vh;"></div>

            </div>
        </div>--}}

        <br>

    </div>

    <br>
@endsection

@section('js')


    <script>

        var locations = {!! json_encode($data) !!}

        /*var locations = [
            ["LOCATION_1", 11.8166, 122.0942],
            ["LOCATION_2", 11.9804, 121.9189],
            ["LOCATION_3", 10.7202, 122.5621],
            ["LOCATION_4", 11.3889, 122.6277],
            ["LOCATION_5", 10.5929, 122.6325]
        ];*/

        var map = L.map('map_alea').setView([9.934886500000001, -11.283844999999985], 7);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 10,
            }).addTo(map);

        for (var i = 0; i < locations.length; i++) {
            marker = new L.marker([locations[i][1], locations[i][2]])
                .bindPopup(locations[i][0])
                .addTo(map);
        }


    </script>
@endsection

