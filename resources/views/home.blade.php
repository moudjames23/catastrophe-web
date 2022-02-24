@extends('layouts.app')

@section('content')
    <div class="container">
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

                                <td class="text-center" style="width: 134px;">
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="btn-group"
                                    >


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
@endsection