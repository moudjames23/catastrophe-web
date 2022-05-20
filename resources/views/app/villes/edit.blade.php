@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('villes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                Mise á jour ville
            </h4>

            <x-form
                method="PUT"
                action="{{ route('villes.update', $ville) }}"
                class="mt-4"
            >
                @include('app.villes.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('villes.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        Retour à la liste
                    </a>

                    <a
                        href="{{ route('villes.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        Enregistrer
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>

    @can('view-any', App\Models\Catastrophe::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Catastrophes</h4>

            <livewire:ville-catastrophes-detail :ville="$ville" />
        </div>
    </div>
    @endcan
</div>
@endsection
