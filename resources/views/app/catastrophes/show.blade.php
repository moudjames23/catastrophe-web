@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('catastrophes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.catastrophes.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.catastrophes.inputs.valeur')</h5>
                    <span>{{ $catastrophe->valeur ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.catastrophes.inputs.url')</h5>
                    <a target="_blank" href="{{ $catastrophe->url }}"
                        >{{ $catastrophe->url ?? '-' }}</a
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.catastrophes.inputs.alea_id')</h5>
                    <span>{{ optional($catastrophe->alea)->nom ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.catastrophes.inputs.ville_id')</h5>
                    <span>{{ optional($catastrophe->ville)->nom ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('catastrophes.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Catastrophe::class)
                <a
                    href="{{ route('catastrophes.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
