@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('aleas.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.aleas.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.aleas.inputs.nom')</h5>
                    <span>{{ $alea->nom ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.aleas.inputs.url')</h5>
                    <a target="_blank" href="{{ $alea->url }}"
                        >{{ $alea->url ?? '-' }}</a
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.aleas.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $alea->image ? \Storage::url($alea->image) : '' }}"
                        size="150"
                    />
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('aleas.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Alea::class)
                <a href="{{ route('aleas.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
