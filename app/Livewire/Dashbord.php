<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Dashbord extends Component
{
    public $proprietors_count = 0;
    public $houses_count = 0;
    public $locators_count = 0;
    public $locations_count = 0;
    public $rooms_count = 0;
    public $paiement_count = 0;
    public $factures_count = 0;
    public $accountSold_count = 0;
    public $initiation_count = 0;

    function __construct()
    {
        $BASE_URL = env("BASE_URL");
        $token = session()->get("token");

        // session()->forget("token");
        $hearders = [
            "Authorization" => "Bearer " . $token,
        ];

        // PROPRETAIRES
        $proprietors = Http::withHeaders($hearders)->get($BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors_count = 0;
        } else {
            $this->proprietors_count = count($proprietors["data"]);
        }

        // MAISONS
        $houses = Http::withHeaders($hearders)->get($BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses_count = 0;
        } else {
            $this->houses_count = count($houses["data"]);
        }

        // LOCATAIRES
        $locators = Http::withHeaders($hearders)->get($BASE_URL . "immo/locataire/all")->json();

        if (!$locators["status"]) {
            $this->locators_count = 0;
        } else {
            $this->locators_count = count($locators["data"]);
        }

        // LOCATIONS
        $locations = Http::withHeaders($hearders)->get($BASE_URL . "immo/location/all")->json();

        if (!$locations["status"]) {
            $this->locations_count = 0;
        } else {
            $this->locations_count = count($locations["data"]);
        }

        // ROOMS
        $rooms = Http::withHeaders($hearders)->get($BASE_URL . "immo/room/all")->json();

        if (!$rooms["status"]) {
            $this->rooms_count = 0;
        } else {
            $this->rooms_count = count($rooms["data"]);
        }

        // PAIEMENTS
        $paiements = Http::withHeaders($hearders)->get($BASE_URL . "immo/paiement/all")->json();

        if (!$paiements["status"]) {
            $this->paiement_count = 0;
        } else {
            $this->paiement_count = count($paiements["data"]);
        }

        // FACTURES
        $factures = Http::withHeaders($hearders)->get($BASE_URL . "immo/facture/all")->json();

        if (!$factures["status"]) {
            $this->factures_count = 0;
        } else {
            $this->factures_count = count($factures["data"]);
        }

        // COMPTES & SOLDES
        $accountSolds = Http::withHeaders($hearders)->get($BASE_URL . "immo/account/all")->json();

        if (!$accountSolds["status"]) {
            $this->accountSold_count = 0;
        } else {
            $this->accountSold_count = count($accountSolds["data"]);
        }

        // INITIATIONS
        $initiations = Http::withHeaders($hearders)->get($BASE_URL . "immo/payement_initiation/all")->json();

        if (!$initiations["status"]) {
            $this->initiation_count = 0;
        } else {
            $this->initiation_count = count($initiations["data"]);
        }
    }

    public function render()
    {
        return view('livewire.dashbord');
    }
}
