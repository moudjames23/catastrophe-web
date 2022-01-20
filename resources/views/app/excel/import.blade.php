@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('catastrophes.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                        ></a>
                    Import excel
                </h4>

                <x-form
                    method="POST"
                    action="{{ route('catastrophe.excel.import') }}"
                    has-files
                    class="mt-4"
                >

                    <div class="row">
                        <x-inputs.group class="col-sm-12">
                            <div

                            >
                                <x-inputs.partials.label
                                    name="file"
                                    label="Fichier excel"
                                ></x-inputs.partials.label
                                ><br />

                                <!-- Show the image -->
                                <template x-if="imageUrl">
                                    <img
                                        :src="imageUrl"
                                        class="object-cover rounded border border-gray-200"
                                        style="width: 100px; height: 100px;"
                                    />
                                </template>



                                <div class="mt-2">
                                    <input
                                        type="file"
                                        name="excel"
                                        id="image"
                                        @change="fileChosen"
                                    />
                                </div>

                                @error('image') @include('components.inputs.partials.error')
                                @enderror
                            </div>
                        </x-inputs.group>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('catastrophes.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            Retour
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                           Importer
                        </button>
                    </div>

                </x-form>

            </div>
        </div>
    </div>
@endsection
