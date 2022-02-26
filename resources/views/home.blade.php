@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin="" />


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
                        <h1 class="number-card-number">{{ $agentsCount }}</h1>

                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Total agents</div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="basic-column w-col w-col-3">
                <div class="tag-wrapper">
                    <div class="number-card number-card-content4">
                        <h1 class="number-card-number">{{ $prefecturesCount }}</h1>

                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Total préfectures</div>

                        </div>
                    </div>

                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">10 dernières alertes signalées</h4>
                </div>

                <div class="searchbar mt-4 mb-5">
                    <div class="row">
                        <div class="col-md-6">
                            <form>
                                <div class="input-group">
                                    <input
                                        id="indexSearch"
                                        type="text"
                                        name="search"
                                        placeholder="{{ __('crud.common.search') }}"
                                        value="{{ $search ?? '' }}"
                                        class="form-control"
                                        autocomplete="off"
                                    />
                                    <div class="input-group-append">
                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 text-right">


                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                        <tr>
                            <th class="text-left">
                                Agent
                            </th>
                            <th class="text-left">
                                Aléa
                            </th>
                            <th class="text-left">
                                Ville
                            </th>

                            <th class="text-left">
                                Localité
                            </th>

                            <th class="text-left">
                                Superficie
                            </th>

                            <th class="text-left">
                                Date
                            </th>

                            <th class="text-left">
                                Personnes touchées
                            </th>

                            <th class="text-left">
                                Image
                            </th>

                            <th class="text-left">
                                Lat / Long
                            </th>


                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($alertes as $alerte)
                            <tr>
                                <td>{{ $alerte->agent->name ?? '-' }}</td>
                                <td>{{ $alerte->alea->nom ?? '-' }}</td>
                                <td>
                                    {{ $alerte->ville->nom ?? '-' }}
                                </td>
                                <td>
                                    {{ $alerte->localite ?? '-' }}
                                </td>

                                <td>
                                    {{ $alerte->superficie ?? '-' }}
                                </td>

                                <td>
                                    {{ $alerte->date ?? '-' }}
                                </td>

                                <td>
                                    {{ $alerte->personnes ?? '-' }}
                                </td>

                                <td>
                                    <x-partials.thumbnail
                                        src="{{ $alerte->image ? \Storage::url($alerte->image) : '' }}"
                                    />
                                </td>

                                <td>
                                    {{ $alerte->latitude. ' / ' .$alerte->longitude }}
                                </td>

                                <td class="text-center" style="width: 134px;">
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="btn-group"
                                    >

                                        <form
                                            action="{{ route('alertes.destroy', $alerte) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="btn btn-light text-danger"
                                            >
                                                <i class="icon ion-md-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>

                        </tr>
                        </tfoot>
                    </table>
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

        <br>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Nombre d'alertes par mois</h4>
                </div>



                <div id="alerte_per_month"></div>

            </div>
        </div>

        <br>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">Nombre d'alertes remontées par aléa</h4>
                </div>



                <div id="alerteByAlea"></div>

            </div>
        </div>




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
                maxZoom: 10,
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

    </script>
@endsection
