<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;


class House extends Component
{
    use WithFileUploads;

    public $houses = [];
    public $houses_count = [];


    // 
    public $countries = [];
    public $proprietors = [];
    public $cities = [];
    public $house_types = [];
    public $departements = [];
    public $quartiers = [];
    public $zones = [];
    public $supervisors = [];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $house_rooms = [];
    public $current_house = [];

    // ADD PROPRIO DATAS
    public $name = "";
    public $latitude = "";
    public $longitude = "";
    public $type = "";
    public $country = "";
    public $city = "";
    public $departement = "";
    public $quartier = "";
    public $zone;
    public $supervisor = "";
    public $proprietor = "";
    public $comments = "";

    // TRAITEMENT DES ERREURS
    public $name_error = "";
    public $latitude_error = "";
    public $longitude_error = "";
    public $type_error = "";
    public $country_error = "";
    public $departement_error = "";
    public $city_error = "";
    public $quartier_error = "";
    public $zone_error = "";
    public $supervisor_error = "";
    public $proprietor_error = "";
    public $comments_error = "";


    public $generalError = "";

    // 
    public $show_form = true;
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

        // PROPRIETAIRES
        $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors = 0;
        } else {
            $this->proprietors = $proprietors["data"];
        }

        // MAISONS
        $houses = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses = [];
            $this->houses_count = 0;
        } else {
            $this->houses = $houses["data"];
            $this->houses_count = count($houses["data"]);
        }

        // PAYS
        $countries = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/country/all")->json();
        if (!$countries["status"]) {
            # code...
            $this->countries = [];
        } else {
            $this->countries = $countries["data"];
        }

        // CITIES
        $cities = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/city/all")->json();
        if (!$cities["status"]) {
            $this->cities = 0;
        } else {
            $this->cities = $cities["data"];
        }


        // HOUSES TYPES
        $house_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/type/all")->json();
        if (!$house_types["status"]) {
            $this->house_types = 0;
        } else {
            $this->house_types = $house_types["data"];
        }

        // DEPARTEMENTS
        $departements = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/departement/all")->json();
        if (!$departements["status"]) {
            $this->departements = 0;
        } else {
            $this->departements = $departements["data"];
        }

        // QUARTIER
        $quartiers = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/quarter/all")->json();
        if (!$quartiers["status"]) {
            $this->quartiers = 0;
        } else {
            $this->quartiers = $quartiers["data"];
        }

        // ZONE
        $zones = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/zone/all")->json();
        if (!$zones["status"]) {
            $this->zones = 0;
        } else {
            $this->zones = $zones["data"];
        }

        // SUPERVISEUR
        $supervisors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/supervisors")->json();
        if (!$supervisors["status"]) {
            $this->supervisors = 0;
        } else {
            $this->supervisors = $supervisors["data"];
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;
        $this->show_form = false;

        // PROPRIETAIRES
        $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors = 0;
        } else {
            $this->proprietors = $proprietors["data"];
        }

        // MAISONS
        $houses = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses = [];
            $this->houses_count = 0;
        } else {
            $this->houses = $houses["data"];
            $this->houses_count = count($houses["data"]);
        }

        // PAYS
        $countries = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/country/all")->json();
        if (!$countries["status"]) {
            # code...
            $this->countries = [];
        } else {
            $this->countries = $countries["data"];
        }

        // CITIES
        $cities = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/city/all")->json();
        if (!$cities["status"]) {
            $this->cities = 0;
        } else {
            $this->cities = $cities["data"];
        }


        // HOUSES TYPES
        $house_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/type/all")->json();
        if (!$house_types["status"]) {
            $this->house_types = 0;
        } else {
            $this->house_types = $house_types["data"];
        }

        // DEPARTEMENTS
        $departements = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/departement/all")->json();
        if (!$departements["status"]) {
            $this->departements = 0;
        } else {
            $this->departements = $departements["data"];
        }

        // QUARTIER
        $quartiers = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/quarter/all")->json();
        if (!$quartiers["status"]) {
            $this->quartiers = 0;
        } else {
            $this->quartiers = $quartiers["data"];
        }

        // ZONE
        $zones = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/zone/all")->json();
        if (!$zones["status"]) {
            $this->zones = 0;
        } else {
            $this->zones = $zones["data"];
        }

        // SUPERVISEUR
        $supervisors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/supervisors")->json();
        if (!$supervisors["status"]) {
            $this->supervisors = 0;
        } else {
            $this->supervisors = $supervisors["data"];
        }
    }

    function showForm()
    {
        $this->click_count++;

        if ($this->show_form) {
            $this->show_form = false;
        } else {
            $this->show_form = true;
        }
    }

    function addHouse()
    {

        $data = [
            "owner" => $this->userId,
            "name" => $this->name,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "type" => $this->type,
            "country" => $this->country,
            "departement" => $this->departement,
            "city" => $this->city,
            "quartier" => $this->quartier,
            "zone" => $this->zone,
            "supervisor" => $this->supervisor,

            "proprietor" => $this->proprietor,
            "comments" => $this->comments,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/house/add", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("name", $errors)) {
                    $this->name_error = $errors["name"][0];
                }

                if (array_key_exists("latitude", $errors)) {
                    $this->latitude_error = $errors["latitude"][0];
                }
                if (array_key_exists("longitude", $errors)) {
                    $this->longitude_error = $errors["longitude"][0];
                }
                if (array_key_exists("type", $errors)) {
                    $this->type_error = $errors["type"][0];
                }
                if (array_key_exists("country", $errors)) {
                    $this->country_error = $errors["country"][0];
                }
                if (array_key_exists("departement", $errors)) {
                    $this->departement_error = $errors["departement"][0];
                }
                if (array_key_exists("city", $errors)) {
                    $this->city_error = $errors["city"][0];
                }
                if (array_key_exists("quartier", $errors)) {
                    $this->quartier_error = $errors["quartier"][0];
                }
                if (array_key_exists("zone", $errors)) {
                    $this->zone_error = $errors["zone"][0];
                }
                if (array_key_exists("supervisor", $errors)) {
                    $this->supervisor_error = $errors["supervisor"][0];
                }
                if (array_key_exists("proprietor", $errors)) {
                    $this->proprietor_error = $errors["proprietor"][0];
                }
                if (array_key_exists("comments", $errors)) {
                    $this->comments_error = $errors["comments"][0];
                }
            } else {
                // $this->generalError = $errors;
                $this->refresh($errors);
            }
        } else {
            $successMsg = $response["message"];

            // $this->__construct();
            // return redirect("/house")->with("success", $successMsg);

            $this->refresh($successMsg);
        }
    }

    public function retrieve(int $id)
    {
        $house = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/{$id}/retrieve")->json();
        if (!$house["status"]) {
            $this->house_rooms = [];
            $this->current_house = [];
        } else {
            $this->house_rooms = $house["data"]["rooms"];
            $this->current_house = $house["data"];
        }
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders($this->hearders)->delete($this->BASE_URL . "immo/house/{$id}/delete")->json();

        if (!$response["status"]) {
            // return redirect("/house")->with("error", $response["erros"]);
            $this->refresh($response["erros"]);
        }
        // return redirect("/house")->with("success", $response["message"]);
        $this->refresh($response["message"]);
    }
    public function render()
    {
        return view('livewire.house');
    }
}
