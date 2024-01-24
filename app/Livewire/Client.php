<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Client extends Component
{

    public $clients;

    function __construct()
    {
        $BASE_URL = env("BASE_URL");
        $token = session()->get("token");
        $userId = session()->get("userId");

        $hearders = [
            "Authorization" => "Bearer " . $token,
        ];

        // les locations de cette maison
        $response = Http::withHeaders($hearders)->get($BASE_URL . "immo/client/all")->json();
        if (!$response["status"]) {
            $this->clients = [];
        }else {
            $this->clients = $response["data"];
        }
        // dd($this->clients[0]["city"]["name"]);
    }

    public function render()
    {
        return view('livewire.client');
    }
}
