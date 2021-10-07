<?php

namespace App\Http\Livewire;

namespace App\Http\Livewire;
use Livewire\Component;

// Les modèles
use App\Models\Pays;
use App\Models\Ville;

class CountriesCitiesSelect extends Component
{
    public $country_id; // L'identifiant du pays
    public $city_id; // L'identifiant de la ville
    public $cities; // la collection de villes

    public function mount() {
        // On affecte une collection vide 
        $this->cities = collect();
    }

    // Quand $country_id change, on charge les $cities de $country_id 
    public function updatedCountryId ($newValue) {
        $this->cities = Ville::where("pays", $newValue)->orderBy("nom")->get();
    }

    public function render()
    {
        // On récupère les pays
        $countries = Pays::select("id", "nom")->get();

        // On retourne la vue avec les pays
        return view('livewire.countries-cities-select', [
            'countries' => $countries
        ]);
    }
}