<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nom"
            label="Nom"
            value="{{ old('nom',  $couche->nom) }}"
            maxlength="255"
            placeholder="Nom"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div>
            <x-inputs.partials.label
                name="image"
                label="Fichier KML"
            ></x-inputs.partials.label
            ><br />

            <div class="mt-2">
                <input
                    type="file"
                    name="kml"
                    id="image"
                    @change="fileChosen"
                />
            </div>

            @error('image') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

</div>
