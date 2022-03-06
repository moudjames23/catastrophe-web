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
                        <h1 class="number-card-number">{{ $alea->nom }}</h1>
                        <div class="number-card-divider"></div>
                        <div class="number-card-progress-wrapper">
                            <div class="tagline number-card-currency">Alea</div>

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
                    <h4 class="card-title">Les alertes du type <b>{{ $alea->nom }}</b></h4>
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
                            <a
                                href="{{ route('alea.alerte.export', $alea->id) }}"
                                class="btn btn-success"
                            >
                                <i class="icon ion-md-add"></i>
                               Exporter en excel
                            </a>
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
                                Ville
                            </th>

                            <th class="text-left">
                                Localité
                            </th>

                            <th class="text-left">
                                Superficie
                            </th>


                            <th class="text-left">
                                 Touchées
                            </th>

                            <th class="text-left">
                                Décédées
                            </th>

                            <th class="text-left">
                                Taux de décés
                            </th>

                            <th class="text-left">
                                Date
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
                                <td>
                                    {{ $alerte->ville->nom ?? '-' }}
                                </td>
                                <td>
                                    {{ $alerte->localite ?? '-' }}
                                </td>

                                <td>
                                    {{ number_format($alerte->superficie, 0, ',', ' ') ?? '-' }}
                                </td>


                                <td>
                                    {{ number_format($alerte->personnes, 0, ',', ' ') ?? '-' }}
                                </td>

                                <td>
                                    {{ number_format($alerte->mort, 0, ',', ' ') ?? '-' }}
                                </td>

                                <td>
                                    {{ number_format($alerte->taux, 2, ',', ' '). ' %' }}
                                </td>

                                <td>
                                    {{ $alerte->date }}
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
                            <td colspan="4">{!! $alertes->render() !!}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
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

        <div class="card">
            <div class="card-body">
                <div style="">
                    <h4 class="card-title">Total des personnes décédées</h4>
                </div>


                <div id="alea_alerte_decede"></div>

            </div>
        </div>

        <br>
        <br>

    </div>

@endsection

@section('js')
    <script>
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

        var onlyMort = {!! json_encode($statTotalMort) !!};
        var onlyVille = {!! json_encode($statTotalVille) !!};

        Highcharts.chart('alea_alerte_decede', {
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
                categories: onlyVille
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
                data: onlyMort
            }]
        });

    </script>
@endsection

