<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;


class Room extends Component
{
    use WithFileUploads;

    public $rooms = [];
    public $rooms_count = [];


    // 
    public $countries = [];
    public $proprietors = [];
    public $houses = [];

    public $cities = [];
    public $room_types = [];
    public $room_natures = [];
    public $departements = [];
    public $quartiers = [];
    public $zones = [];
    public $supervisors = [];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $room_locations = [];
    public $current_room = [];

    // ADD ROOM DATAS
    public $loyer = "";
    public $number = "";
    public $security;
    public $rubbish;
    public $vidange;
    public $cleaning;
    public $nature = "";
    public $type;
    public $proprietor = "";
    public $house = "";

    public $water_counter = false;
    public $water_discounter = false;

    public $electric_counter = false;
    public $electric_discounter = false;

    public $publish = true;
    public $home_banner = false;
    public $principal_img;
    public $comments = "";

    // TRAITEMENT DES ERREURS
    public $loyer_error = "";
    public $number_error = "";
    public $security_error = "";
    public $vidange_error = "";
    public $cleaning_error = "";
    public $nature_error = "";
    public $type_error = "";
    public $rubbish_error = "";
    public $proprietor_error = "";
    public $house_error = "";


    public $water_counter_error = "";
    public $water_discounter_error = "";

    public $electric_counter_error = "";
    public $electric_discounter_error = "";

    public $principal_img_error = "";
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

        // // PROPRIETAIRES
        // $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        // $this->proprietors = $proprietors["data"];
        // // dd($this->proprietors);

        // CHAMBRES
        $rooms = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/all")->json();
        if (!$rooms["status"]) {
            $this->rooms = [];
            $this->rooms_count = 0;
        } else {
            $this->rooms = $rooms["data"];
            $this->rooms_count = count($rooms["data"]);
        }


        // MAISONS
        $houses = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses = [];
        } else {
            $this->houses = $houses["data"];
        }

        // roomS TYPES
        $room_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/type/all")->json();
        if (!$room_types["status"]) {
            $this->room_types = [];
        } else {
            $this->room_types = $room_types["data"];
        }

        // ROOM NATURE
        $room_natures = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/nature/all")->json();
        if (!$room_natures["status"]) {
            $this->room_natures = [];
        } else {
            $this->room_natures = $room_natures["data"];
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;
        $this->show_form = false;

        // CHAMBRES
        $rooms = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/all")->json();
        if (!$rooms["status"]) {
            $this->rooms = [];
            $this->rooms_count = 0;
        } else {
            $this->rooms = $rooms["data"];
            $this->rooms_count = count($rooms["data"]);
        }


        // MAISONS
        $houses = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses = [];
        } else {
            $this->houses = $houses["data"];
        }

        // roomS TYPES
        $room_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/type/all")->json();
        if (!$room_types["status"]) {
            $this->room_types = [];
        } else {
            $this->room_types = $room_types["data"];
        }

        // ROOM NATURE
        $room_natures = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/nature/all")->json();
        if (!$room_natures["status"]) {
            $this->room_natures = [];
        } else {
            $this->room_natures = $room_natures["data"];
        }
    }

    function manageBanner()
    {
        if ($this->home_banner) {
            $this->home_banner = false;
        } else {
            $this->home_banner = true;
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

    function addRoom()
    {
        $data = [
            "owner" => $this->userId,
            "loyer" => $this->loyer,
            "number" => $this->number,
            "security" => $this->security,
            "rubbish" => $this->rubbish,
            "vidange" => $this->vidange,
            "cleaning" => $this->cleaning,
            "nature" => $this->nature,
            "type" => $this->type,
            "proprietor" => $this->proprietor,
            "house" => $this->house,

            "water_counter" => $this->water_counter,

            "water_counter" => $this->water_counter,
            "water_discounter" => $this->water_discounter,
            "electric_counter" => $this->electric_counter,
            "electric_discounter" => $this->electric_discounter,
            "publish" => $this->publish,
            "home_banner" => $this->home_banner,
            "principal_img" => $this->principal_img,
            "comments" => $this->comments,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/room/add", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("loyer", $errors)) {
                    $this->loyer_error = $errors["loyer"][0];
                }

                if (array_key_exists("security", $errors)) {
                    $this->security_error = $errors["security"][0];
                }
                if (array_key_exists("rubbish", $errors)) {
                    $this->rubbish_error = $errors["rubbish"][0];
                }
                if (array_key_exists("vidange", $errors)) {
                    $this->vidange_error = $errors["vidange"][0];
                }
                if (array_key_exists("number", $errors)) {
                    $this->number_error = $errors["number"][0];
                }
                if (array_key_exists("cleaning", $errors)) {
                    $this->cleaning_error = $errors["cleaning"][0];
                }
                if (array_key_exists("water_counter", $errors)) {
                    $this->water_counter_error = $errors["water_counter"][0];
                }
                if (array_key_exists("water_discounter", $errors)) {
                    $this->water_discounter_error = $errors["water_discounter"][0];
                }
                if (array_key_exists("house", $errors)) {
                    $this->house_error = $errors["house"][0];
                }
                if (array_key_exists("nature", $errors)) {
                    $this->nature_error = $errors["nature"][0];
                }
                if (array_key_exists("type", $errors)) {
                    $this->type_error = $errors["type"][0];
                }
                if (array_key_exists("proprietor", $errors)) {
                    $this->proprietor_error = $errors["proprietor"][0];
                }

                if (array_key_exists("electric_counter", $errors)) {
                    $this->electric_counter_error = $errors["electric_counter"][0];
                }
                if (array_key_exists("electric_discounter", $errors)) {
                    $this->electric_discounter_error = $errors["electric_discounter"][0];
                }
                if (array_key_exists("principal_img", $errors)) {
                    $this->principal_img_error = $errors["principal_img"][0];
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
            $this->refresh($successMsg);
        }
    }

    public function retrieve(int $id)
    {
        $room = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/{$id}/retrieve")->json();

        if (!$room["status"]) {
            $this->room_locations = [];
            $this->current_room = [];
        } else {
            $this->room_locations = $room["data"]["locations"];
            $this->current_room = $room["data"];
        }
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders($this->hearders)->delete($this->BASE_URL . "immo/room/{$id}/delete")->json();

        if (!$response["status"]) {
            return redirect("/room")->with("error", $response["erros"]);
            $this->refresh($response["erros"]);
        }
        $this->refresh($response["message"]);
    }
    public function render()
    {
        return view('livewire.room');
    }
}
