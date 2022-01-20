@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.catastrophes.index_title')
                </h4>
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
                        @can('create', App\Models\Catastrophe::class)
                        <a
                            href="{{ route('catastrophes.create') }}"
                            class="btn btn-primary"
                        >
                            <i class="icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                        @endcan
                            <a
                                href="{{ route('catastrophe.excel.form') }}"
                                class="btn btn-primary"
                            >
                                <i class="icon ion-md-add"></i>
                                Fichier excel
                            </a>
                    </div>
                </div>
            </div>

            @php $etat = ["Faible", "Moyen", "Haut"] @endphp
            @php $couleurs = ["text-success", "text-orange", "text-danger"] @endphp

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.catastrophes.inputs.ville_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.catastrophes.inputs.alea_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.catastrophes.inputs.valeur')
                            </th>
                            <th class="text-left">
                                @lang('crud.catastrophes.inputs.url')
                            </th>


                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($catastrophes as $catastrophe)
                        <tr>
                            <td>
                                {{ optional($catastrophe->ville)->nom ?? '-' }}
                            </td>
                            <td>
                                {{ optional($catastrophe->alea)->nom ?? '-' }}
                            </td>
                            <td>
                                @if($catastrophe->valeur)
                                    <label for="" class="label {{ $couleurs[$catastrophe->valeur - 1] }}">
                                        {{ $etat[$catastrophe->valeur - 1] }}
                                    </label>
                                @endif
                            </td>
                            <td>
                                <a
                                    target="_blank"
                                    href="{{ $catastrophe->url }}"
                                    >{{ $catastrophe->url ?? '-' }}</a
                                >
                            </td>


                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $catastrophe)
                                    <a
                                        href="{{ route('catastrophes.edit', $catastrophe) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $catastrophe)
                                    <a
                                        href="{{ route('catastrophes.show', $catastrophe) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $catastrophe)
                                    <form
                                        action="{{ route('catastrophes.destroy', $catastrophe) }}"
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
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{!! $catastrophes->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
