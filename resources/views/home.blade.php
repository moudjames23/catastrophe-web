@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

@endsection

@section('content')
    <div class="container">

        <div class="row w-row">
            <div class="basic-column w-col w-col-3">
                <div class="tag-wrapper">
                    <div class="number-card number-card-content1">
                        <h1 class="number-card-number">{{ $aleasCount }}</h1>
                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Total aléas</div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="basic-column w-col w-col-3">
                <div class="tag-wrapper">
                    <div class="number-card number-card-content2">
                        <h1 class="number-card-number">{{ $alertesCount }}</h1>

                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Total alertes</div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="basic-column w-col w-col-3">
                <div class="tag-wrapper">
                    <div class="number-card number-card-content3">
                        <h1 class="number-card-number">{{ number_format($personnesTouchees->personnes) }}</h1>

                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Touchées</div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="basic-column w-col w-col-3">
                <div class="tag-wrapper">
                    <div class="number-card number-card-content4">
                        <h1 class="number-card-number">{{ number_format($morts->decedes) }}</h1>

                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Décédées</div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <div class="container">

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Carte interactive</h4>
                </div>


                <div id="map" style="height: 50vh; width: 100vh;"></div>

            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="container">
        <div class="">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between;">
                        <h4 class="card-title">Nombre d'alertes remontées par aléa</h4>
                    </div>


                    <div id="alerteByAlea"></div>

                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="">
                    <h4 class="card-title">Total des personnes décédées par aléa</h4>
                </div>


                <div id="alea_decedes_per_prefecture"></div>

            </div>
        </div>


        <br>
        <br>

        <div class="card">
            <div class="card-body">
                <div style="">
                    <h4 class="card-title">Nombre d'alertes par mois</h4>
                </div>


                <div id="alerte_per_month"></div>

            </div>
        </div>

        <br>
        <br>


        <div class="card">
            <div class="card-body">
                <div style="">
                    <h4 class="card-title">Total des personnes touchées par préfecture</h4>
                </div>


                <div id="alea_personne_per_prefecture"></div>

            </div>
        </div>

        <br>
        <br>







    </div>











@endsection

@section('js')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>

    <script>

        var locations = {!! json_encode($data) !!}

        /*var locations = [
            ["LOCATION_1", 11.8166, 122.0942],
            ["LOCATION_2", 11.9804, 121.9189],
            ["LOCATION_3", 10.7202, 122.5621],
            ["LOCATION_4", 11.3889, 122.6277],
            ["LOCATION_5", 10.5929, 122.6325]
        ];*/

        var map = L.map('map').setView([9.934886500000001, -11.283844999999985], 7);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 30,
            }).addTo(map);

        for (var i = 0; i < locations.length; i++) {
            marker = new L.marker([locations[i][1], locations[i][2]])
                .bindPopup(locations[i][0])
                .addTo(map);
        }

        var onlyMonths = {!! json_encode($statAlerteParMoiOnlyMonth) !!};
        var onlyData = {!! json_encode($statAlerterParMoiOnlyTotal) !!};

        Highcharts.chart('alerte_per_month', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Tendance sur la remontée des alertes par mois'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: onlyMonths
            },
            yAxis: {
                title: {
                    text: 'Evolution'
                },
                labels: {
                    formatter: function () {
                        return this.value + '';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'diamond'
                },
                data: onlyData
            }]
        });


        var alertByAlea = {!! json_encode($alerteByAlea) !!};
        Highcharts.chart('alerteByAlea', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: alertByAlea
            }]
        });

        var personnnes = {!! json_encode($personnes) !!};
        Highcharts.chart('alea_personne_per_prefecture', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Personnes touchées'
            },
            subtitle: {
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:1f}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:2f}</b><br/>'
            },

            series: [
                {
                    name: "Personnes touchées",
                    colorByPoint: true,
                    data: personnnes
                }
            ]

        });

        var personnesDecedes = {!! json_encode($personnesDecedes) !!};
        Highcharts.chart('alea_decedes_per_prefecture', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: personnesDecedes
            }]
        });



    </script>
@endsection
