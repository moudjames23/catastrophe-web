@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('agents.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
               Mise à jour
            </h4>

            <x-form
                method="PUT"
                action="{{ route('agents.update', $agent) }}"
                has-files
                class="mt-4"
            >
                @include('app.agents.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('agents.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a href="{{ route('agents.index') }}" class="btn btn-light">
                        <i class="icon ion-md-add text-primary"></i>
                        Retour
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        Enregistrer
                    </button>
                </div>
            </x-form>
        </div>
    </div>
</div>
@endsection
