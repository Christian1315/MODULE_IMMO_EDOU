<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Laravel\Prompts\confirm;

class Proprietor extends Component
{
    use WithFileUploads;

    public $proprietors = [];
    public $proprietors_count = [];


    // 
    public $countries = [];
    public $cities = [];
    public $card_types = [];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $proprietor_houses = [];
    public $current_proprietor = [];

    // ADD PROPRIO DATAS
    public $firstname = "";
    public $lastname = "";
    public $phone = "";
    public $email = "";
    public $sexe = "";
    public $piece_number = "";
    public $mandate_contrat;
    public $adresse = "";
    public $country = "";
    public $city = "";
    public $card_type = "";
    public $comments = "";

    // TRAITEMENT DES ERREURS
    public $firstname_error = "";
    public $lastname_error = "";
    public $phone_error = "";
    public $email_error = "";
    public $sexe_error = "";
    public $piece_number_error = "";
    public $mandate_contrat_error = "";
    public $adresse_error = "";
    public $country_error = "";
    public $city_error = "";
    public $card_type_error = "";
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

        // PROPRETAIRES
        $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors = [];
            $this->proprietors_count = 0;
        } else {
            $this->proprietors = $proprietors["data"];
            $this->proprietors_count = count($proprietors["data"]);
        }

        // PAYS
        $countries = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/country/all")->json();
        if (!$countries["status"]) {
            $this->countries = [];
        }else {
            $this->countries = $countries["data"];
        }

        // CITIES
        $cities = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/city/all")->json();
        if (!$cities["status"]) {
            $this->cities = [];
        }else {
            $this->cities = $cities["data"];
        }

        // CARD TYPES
        $card_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/cardType/all")->json();
        if (!$card_types["status"]) {
            $this->card_types = [];
        }else {
            $this->card_types = $card_types["data"];
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;


        // PROPRETAIRES
        $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors = [];
            $this->proprietors_count = 0;
        } else {
            $this->proprietors = $proprietors["data"];
            $this->proprietors_count = count($proprietors["data"]);
        }

        // PAYS
        $countries = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/country/all")->json();
        if (!$countries["status"]) {
            $this->countries = [];
        }else {
            $this->countries = $countries["data"];
        }

        // CITIES
        $cities = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/city/all")->json();
        if (!$cities["status"]) {
            $this->cities = [];
        }else {
            $this->cities = $cities["data"];
        }

        // CARD TYPES
        $card_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/cardType/all")->json();
        if (!$card_types["status"]) {
            $this->card_types = [];
        }else {
            $this->card_types = $card_types["data"];
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

    function addProprio()
    {

        $data = [
            "owner" => $this->userId,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "phone" => $this->phone,
            "email" => $this->email,
            "sexe" => $this->sexe,
            "piece_number" => $this->piece_number,
            "mandate_contrat" => $this->mandate_contrat,
            "adresse" => $this->adresse,
            "country" => $this->country,
            "city" => $this->city,

            "card_type" => $this->card_type,
            "comments" => $this->comments,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/proprietor/add", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("firstname", $errors)) {
                    $this->firstname_error = $errors["firstname"][0];
                }

                if (array_key_exists("piece_number", $errors)) {
                    $this->piece_number_error = $errors["piece_number"][0];
                }
                if (array_key_exists("lastname", $errors)) {
                    $this->lastname_error = $errors["lastname"][0];
                }
                if (array_key_exists("phone", $errors)) {
                    $this->phone_error = $errors["phone"][0];
                }
                if (array_key_exists("email", $errors)) {
                    $this->email_error = $errors["email"][0];
                }
                if (array_key_exists("sexe", $errors)) {
                    $this->sexe_error = $errors["sexe"][0];
                }
                if (array_key_exists("piece_number", $errors)) {
                    $this->piece_number = $errors["piece_number"][0];
                }
                if (array_key_exists("mandate_contrat", $errors)) {
                    $this->mandate_contrat_error = $errors["mandate_contrat"][0];
                }
                if (array_key_exists("adresse", $errors)) {
                    $this->adresse_error = $errors["adresse"][0];
                }
                if (array_key_exists("country", $errors)) {
                    $this->country_error = $errors["country"][0];
                }
                if (array_key_exists("city", $errors)) {
                    $this->city_error = $errors["city"][0];
                }
                if (array_key_exists("card_type", $errors)) {
                    $this->card_type_error = $errors["card_type"][0];
                }
                if (array_key_exists("comments", $errors)) {
                    $this->comments_error = $errors["comments"][0];
                }
            } else {
                // $this->generalError = ;
                $this->refresh($errors);
            }
        } else {
            $successMsg = $response["message"];

            // return redirect("/proprietor")->with("success", $successMsg);

            $this->refresh($successMsg);
        }
    }

    public function retrieve(int $id)
    {
        $proprietor = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/{$id}/retrieve")->json();
        if (!$proprietor["status"]) {
            $this->proprietor_houses = [];
            $this->current_proprietor = [];
        } else {
            $this->proprietor_houses = $proprietor["data"]["houses"];
            $this->current_proprietor = $proprietor["data"];
        }
        
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders($this->hearders)->delete($this->BASE_URL . "immo/proprietor/{$id}/delete")->json();

        if (!$response["status"]) {
            // return redirect("/proprietor")->with("error", $response["erros"]);
            $this->refresh($response["erros"]);
        }
        // return redirect("/proprietor")->with("success", $response["message"]);
        $this->refresh($response["message"]);
    }

    public function render()
    {
        return view('livewire.proprietor');
    }
}
