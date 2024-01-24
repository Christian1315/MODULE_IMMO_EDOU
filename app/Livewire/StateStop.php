<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class StateStop extends Component
{

    public $houseId;
    public $locations=[];

    public $states=[];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];


    function mount($houseId)
    {
        $this->houseId = $houseId;
        // dd($houseId);
    }

    function __construct()
    {
        $this->BASE_URL = env("BASE_URL");
        $this->token = session()->get("token");
        $this->userId = session()->get("userId");

        $this->hearders = [
            "Authorization" => "Bearer " . $this->token,
        ];

        // les locations de cette maison
        $response = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/{$this->houseId}/retrieve")->json();

        // $house = $response["data"];
        // dd($response);
        // $this->locations = $response["data"]["locations"];

        // LES ETATS DE CETTE MAISON
        $res = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house_state/house/{$this->houseId}/all")->json();
        // $this->states = $res["data"];
       
        // dd($this->states);
    }

    public function render()
    {
        return view('livewire.state-stop');
    }
}
