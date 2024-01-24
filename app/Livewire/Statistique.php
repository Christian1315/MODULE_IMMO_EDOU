<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Statistique extends Component
{
    use WithFileUploads;

    public $locations = [];
    public $locations_count = [];

    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $location_locatorsBefore = [];
    public $location_locatorsAfter = [];

    public $current_locationId = [];

    public $generalError = "";


    public $show_locatorsBefore = false;
    public $show_locatorsAfter = false;

    public $currentActivelocation;

    public $click_count = 2;


    function __construct()
    {
        $this->BASE_URL = env("BASE_URL");
        // session()->forget("token");
        $this->token = session()->get("token");
        $this->userId = session()->get("userId");

        $this->hearders = [
            "Authorization" => "Bearer " . $this->token,
        ];

        // LOCATIONS
        $locations = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/location/all")->json();
        if (!$locations["status"]) {
            $this->locations = [];
            $this->locations_count = 0;
            // return redirect("/login")->with("error","Vous n'êtes pas connecté!");
            // return redirect("/")->with("error","Vous n'êtes pas connecté!");

        } else {
            $this->locations = $locations["data"];
            $this->locations_count = count($locations["data"]);
        }
    }

    public function showLocatorBeforeStates(int $id)
    {
        $this->show_locatorsAfter = false;
        $location = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/{$id}/filtre_after_stateDate_stoped")->json();
        if (array_key_exists("erros", $location)) {
            $this->location_locatorsBefore = [];
            $this->generalError = $location["erros"];
            // alert()
        } else {
            $this->location_locatorsBefore = $location["data"]["beforeStopDate"];
            $this->generalError = "";
        }
        $this->current_locationId = $id;

        if ($this->show_locatorsBefore) {
            $this->show_locatorsBefore = false;
        } else {
            $this->show_locatorsBefore = true;
        }
    }

    public function showLocatorAfterStates(int $id)
    {
        $this->show_locatorsBefore = false;
        $location = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/{$id}/filtre_after_stateDate_stoped")->json();
        if (array_key_exists("erros", $location)) {
            $this->location_locatorsAfter = [];
            $this->generalError = $location["erros"];
        } else {
            $this->location_locatorsAfter = $location["data"]["afterStopDate"];
            $this->generalError = "";
        }
        $this->current_locationId = $id;

        if ($this->show_locatorsAfter) {
            $this->show_locatorsAfter = false;
        } else {
            $this->show_locatorsAfter = true;
        }
    }

    public function render()
    {
        return view('livewire.statistique');
    }
}
