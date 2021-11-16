<div>
    <!-- L'état de chargement de données -->
    <p wire:loading >Chargement de données ...</p>

    <!-- Les pays -->
    <p>
        <label for="country_id" >Sélectionnez un pays</label>
        
        <!-- Data Binding : <select> avec la propriété $country_id -->
        <select id="country_id" wire:model="country_id" >

            <option value="" >Séléctionner un pays</option>

            <!-- On parcourt la collection de pays pour afficher chaque pays -->
            @foreach ($countries as $country)
            <option value="{{ $country->id }}" >{{ $country->nom }}</option>
            @endforeach

        </select>
    </p>

    <!-- On vérifie si la collection de villes contient des éléments -->
    @if($cities->count())
    <p>
        <label for="city_id" >Sélectionnez une ville</label>

        <!-- Data Binding : <select> avec la propriété $city_id -->
        <select id="city_id" wire:model="city_id" >

            <option value="" >Sélectionnez une ville</option>

            <!-- On parcourt la collection de villes pour afficher chaque ville -->
            @foreach ($cities as $city)
            <option value="{{ $city->id }}" >{{ $city->nom }}</option>
            @endforeach

        </select>
    </p>
    @endif
</div>
