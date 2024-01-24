<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Locator extends Component
{
    use WithFileUploads;

    public $locators = [];
    public $locators_count = [];

    public $card_types = [];
    public $countries = [];
    public $departements = [];


    public $proprietors = [];
    public $houses = [];

    public $cities = [];
    public $locator_types = [];
    public $locator_natures = [];
    public $quartiers = [];
    public $zones = [];
    public $supervisors = [];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $locator_houses = [];
    public $locator_rooms = [];
    public $current_locator = [];
    public $current_locator_for_room = [];


    // ADD locator DATAS
    public $name = "";
    public $prenom = "";
    public $email;
    public $sexe;
    public $phone;
    public $piece_number;
    public $mandate_contrat = "";
    public $adresse;
    public $card_id = "";
    public $card_type = "";

    public $country = "";
    public $departement = "";
    public $comments = "";

    // TRAITEMENT DES ERREURS
    public $name_error = "";
    public $prenom_error = "";
    public $email_error = "";
    public $sexe_error = "";
    public $phone_error = "";
    public $piece_number_error = "";
    public $mandate_contrat_error = "";
    public $adresse_error = "";
    public $card_id_error = "";
    public $card_type_error = "";
    public $country_error = "";
    public $departement_error = "";
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
        // LOCATAIRES
        $locators = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/locataire/all")->json();
        if (!$locators["status"]) {
            $this->locators = [];
            $this->locators_count = 0;
        } else {
            $this->locators = $locators["data"];
            $this->locators_count = count($locators["data"]);
        }

        // CARD TYPES
        $card_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/cardType/all")->json();
        if (!$card_types["status"]) {
            $this->card_types = [];
        } else {
            $this->card_types = $card_types["data"];
        }

        // PAYS
        $countries = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/country/all")->json();
        if (!$countries["status"]) {
            $this->countries = [];
        } else {
            $this->countries = $countries["data"];
        }

        // DEPARTEMENTS
        $departements = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/departement/all")->json();
        if (!$departements["status"]) {
            $this->departements = [];
        } else {
            $this->departements = $departements["data"];
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;

        // LOCATAIRES
        $locators = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/locataire/all")->json();
        if (!$locators["status"]) {
            $this->locators = [];
            $this->locators_count = 0;
        } else {
            $this->locators = $locators["data"];
            $this->locators_count = count($locators["data"]);
        }

        // CARD TYPES
        $card_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/cardType/all")->json();
        if (!$card_types["status"]) {
            $this->card_types = [];
        } else {
            $this->card_types = $card_types["data"];
        }

        // PAYS
        $countries = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/country/all")->json();
        if (!$countries["status"]) {
            $this->countries = [];
        } else {
            $this->countries = $countries["data"];
        }

        // DEPARTEMENTS
        $departements = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/departement/all")->json();
        if (!$departements["status"]) {
            $this->departements = [];
        } else {
            $this->departements = $departements["data"];
        }
    }

    function showForm()
    {
        if ($this->show_form) {
            $this->show_form = false;
        } else {
            $this->show_form = true;
        }
        $this->locator_houses = [];
        $this->locator_rooms = [];
    }

    function addlocator()
    {

        $data = [
            "owner" => $this->userId,
            "name" => $this->name,
            "prenom" => $this->prenom,
            "email" => $this->email,
            "sexe" => $this->sexe,
            "phone" => $this->phone,
            "piece_number" => $this->piece_number,
            "mandate_contrat" => $this->mandate_contrat,
            "adresse" => $this->adresse,
            "card_id" => $this->card_id,
            "card_type" => $this->card_type,
            "departement" => $this->departement,
            "country" => $this->country,
            "comments" => $this->comments,
            // "mandate_contrat" => $this->mandate_contrat,
        ];


        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/locataire/add", $data)->json();
        // dd($response);
        if (!$response) {
            $this->refresh("Une erreure est survenue! Veuillez réessayer à nouveau!");
        } else {
            if (!$response["status"]) {
                $errors = $response["erros"];
                if (gettype($errors) == "array") {
                    if (array_key_exists("name", $errors)) {
                        $this->name_error = $errors["name"][0];
                    }

                    if (array_key_exists("prenom", $errors)) {
                        $this->prenom_error = $errors["prenom"][0];
                    }
                    if (array_key_exists("email", $errors)) {
                        $this->email_error = $errors["email"][0];
                    }
                    if (array_key_exists("sexe", $errors)) {
                        $this->sexe_error = $errors["sexe"][0];
                    }
                    if (array_key_exists("phone", $errors)) {
                        $this->phone_error = $errors["phone"][0];
                    }
                    if (array_key_exists("piece_number", $errors)) {
                        $this->piece_number_error = $errors["piece_number"][0];
                    }
                    if (array_key_exists("mandate_contrat", $errors)) {
                        $this->mandate_contrat_error = $errors["mandate_contrat"][0];
                    }
                    if (array_key_exists("adresse", $errors)) {
                        $this->adresse_error = $errors["adresse"][0];
                    }
                    if (array_key_exists("card_id", $errors)) {
                        $this->card_id_error = $errors["card_id"][0];
                    }
                    if (array_key_exists("card_type", $errors)) {
                        $this->card_type_error = $errors["card_type"][0];
                    }
                    if (array_key_exists("card_type", $errors)) {
                        $this->card_type_error = $errors["card_type"][0];
                    }
                    if (array_key_exists("country", $errors)) {
                        $this->country_error = $errors["country"][0];
                    }

                    if (array_key_exists("departement", $errors)) {
                        $this->departement_error = $errors["departement"][0];
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
                // return redirect("/locator")->with("success", $successMsg);
                $this->refresh($successMsg);
            }
        }
    }

    public function showHouses(int $id)
    {
        $this->show_form = false;

        $locator = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/locataire/{$id}/retrieve")->json();
        $this->locator_houses = $locator["data"]["houses"];
        $this->current_locator_for_room = [];
        $this->current_locator = $locator["data"];
        // dd($this->locator_houses);
    }

    public function showRooms(int $id)
    {
        $this->show_form = false;

        $locator = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/locataire/{$id}/retrieve")->json();
        if (!$locator["status"]) {
            $this->locator_rooms = [];
            $this->current_locator = [];
            $this->current_locator_for_room = [];
        }else {
            $this->locator_rooms = $locator["data"]["rooms"];
            $this->current_locator = [];
            $this->current_locator_for_room = $locator["data"];
        }
        // dd($this->locator_rooms);
    }

    public function delete(int $id)
    {
        $this->show_form = false;
        $response = Http::withHeaders($this->hearders)->delete($this->BASE_URL . "immo/locataire/{$id}/delete")->json();

        if (!$response["status"]) {
            $this->refresh($response["erros"]);
        }
        $this->refresh($response["message"]);
    }
    public function render()
    {
        return view('livewire.locator');
    }
}
