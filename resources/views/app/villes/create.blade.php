@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('villes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
               Nouvelle préfecture
            </h4>

            <x-form
                method="POST"
                action="{{ route('villes.store') }}"
                class="mt-4"
            >
                @include('app.villes.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('villes.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                       Retour
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                       Ajouter
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
