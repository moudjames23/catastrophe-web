@php $editing = isset($catastrophe) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="valeur"
            label="Valeur"
            value="{{ old('valeur', ($editing ? $catastrophe->valeur : '')) }}"
            max="255"
            placeholder="Valeur"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.url
            name="url"
            label="Url"
            value="{{ old('url', ($editing ? $catastrophe->url : '')) }}"
            maxlength="255"
            placeholder="Url"
        ></x-inputs.url>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="alea_id" label="Alea" required>
            @php $selected = old('alea_id', ($editing ? $catastrophe->alea_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Alea</option>
            @foreach($aleas as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="ville_id" label="Ville" required>
            @php $selected = old('ville_id', ($editing ? $catastrophe->ville_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Ville</option>
            @foreach($villes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
