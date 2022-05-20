@php $editing = isset($agent) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nom"
            value="{{ old('name', ($editing ? $agent->name : '')) }}"
            maxlength="255"
            placeholder="Nom"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="Numéro de téléphone"
            value="{{ old('phone', ($editing ? $agent->phone : '')) }}"
            maxlength="255"
            placeholder="Numero de téléphone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    @if($editing)

        <x-inputs.group class="col-sm-12">
            <x-inputs.text
                name="identifiant"
                label="identifiant"
                value="{{ old('identifiant', ($editing ? $agent->identifiant : '')) }}"
                maxlength="255"
                placeholder="Identifiant"
                required
            ></x-inputs.text>
        </x-inputs.group>
    @endif


</div>
