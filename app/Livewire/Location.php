<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Location extends Component
{
    use WithFileUploads;


    public $locations = [];
    public $locations_count = [];

    public $rooms = [];

    public $card_types = [];
    public $countries = [];
    public $departements = [];

    public $proprietors = [];
    public $houses = [];
    public $locators = [];
    public $locator_types = [];

    public $cities = [];
    public $location_types = [];
    public $location_natures = [];
    public $quartiers = [];
    public $zones = [];
    public $supervisors = [];

    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $location_factures = [];
    public $location_rooms = [];
    public $current_location = [];
    public $current_location_for_room = [];

    public $paiements_types = [];
    public $factures_status = [];

    // ADD location DATAS
    public $house = "";
    public $room = "";
    public $locataire;
    public $type;
    public $caution_bordereau;
    public $loyer;
    public $water_counter = "";
    public $electric_counter;
    public $prestation = "";
    public $numero_contrat = "";

    public $img_contrat = "";
    public $caution_water = "";
    public $echeance_date = "";

    public $latest_loyer_date = "";
    public $img_prestation = "";
    public $caution_number = "";
    public $caution_electric = "";

    public $integration_date = "";
    public $comments = "";


    // TRAITEMENT DES ERREURS
    public $house_error = "";
    public $room_error = "";
    public $locataire_error = "";
    public $type_error = "";
    public $caution_bordereau_error = "";
    public $loyer_error = "";
    public $water_counter_error = "";
    public $electric_counter_error = "";
    public $prestation_error = "";
    public $numero_contrat_error = "";
    public $img_contrat_error = "";
    public $caution_water_error = "";
    public $echeance_date_error = "";
    public $latest_loyer_date_error = "";
    public $img_prestation_error = "";
    public $caution_number_error = "";
    public $caution_electric_error = "";

    public $integration_date_error = "";
    public $comments_error = "";

    public $generalError = "";
    // 
    public $show_form = true;
    public $show_demenage_form = false;
    public $show_encaisse_form = false;
    public $show_traitFacture_form = false;

    public $showCautions = false;
    public $cautions_link = "";

    public $click_count = 2;

    public $activeLocationId;
    public $activeFactureId;

    // MOVING A LOCATION
    public $move_comments = "";
    public $move_comments_error = "";

    // ENCAISSE A LOCATION
    public $encaisse_paiement_type = "";
    public $encaisse_facture = "";
    public $encaisse_mount = "";

    public $encaisse_paiement_type_error = "";
    public $encaisse_mount_error = "";
    public $encaisse_facture_error = "";

    // TRAITEMENT DES FACTURES
    public $trait_facture_status = "";

    public $trait_facture_status_error = "";

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
        } else {
            $this->locations = $locations["data"];
            $this->locations_count = count($locations["data"]);
        }


        // ROOMS
        $rooms = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/all")->json();
        if (!$rooms["status"]) {
            $this->rooms = [];
        } else {
            $this->rooms = $rooms["data"];
        }

        // MAISONS
        $houses = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses = [];
        } else {
            $this->houses = $houses["data"];
        }

        // LOCATAIRES
        $locators = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/locataire/all")->json();
        if (!$locators["status"]) {
            $this->locators = [];
        } else {
            $this->locators = $locators["data"];
        }

        // LOCATAIRES
        $location_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/location/type/all")->json();
        if (!$location_types["status"]) {
            $this->location_types = [];
        } else {
            $this->location_types = $location_types["data"];
        }

        // CARD TYPES
        $paiements_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/type/all")->json();
        if (!$paiements_types["status"]) {
            $this->paiements_types = [];
        } else {
            $this->paiements_types = $paiements_types["data"];
        }

        // FACTURES STATUS
        $factures_status = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/facture/status/all")->json();
        if (!$factures_status["status"]) {
            $this->factures_status = [];
        } else {
            $this->factures_status = $factures_status["data"];
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;

        // LOCATIONS
        $locations = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/location/all")->json();
        if (!$locations["status"]) {
            $this->locations = [];
            $this->locations_count = 0;
        } else {
            $this->locations = $locations["data"];
            $this->locations_count = count($locations["data"]);
        }


        // ROOMS
        $rooms = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/room/all")->json();
        if (!$rooms["status"]) {
            $this->rooms = [];
        } else {
            $this->rooms = $rooms["data"];
        }

        // MAISONS
        $houses = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/house/all")->json();
        if (!$houses["status"]) {
            $this->houses = [];
        } else {
            $this->houses = $houses["data"];
        }

        // LOCATAIRES
        $locators = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/locataire/all")->json();
        if (!$locators["status"]) {
            $this->locators = [];
        } else {
            $this->locators = $locators["data"];
        }

        // LOCATAIRES
        $location_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/location/type/all")->json();
        if (!$location_types["status"]) {
            $this->location_types = [];
        } else {
            $this->location_types = $location_types["data"];
        }

        // CARD TYPES
        $paiements_types = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/type/all")->json();
        if (!$paiements_types["status"]) {
            $this->paiements_types = [];
        } else {
            $this->paiements_types = $paiements_types["data"];
        }

        // FACTURES STATUS
        $factures_status = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/facture/status/all")->json();
        if (!$factures_status["status"]) {
            $this->factures_status = [];
        } else {
            $this->factures_status = $factures_status["data"];
        }

        // $this->encaisse_paiement_type_error = "";
        // $this->encaisse_mount_error = "";
        // $this->encaisse_facture_error = "";

        $this->show_encaisse_form = false;
        $this->show_demenage_form = false;
        $this->show_traitFacture_form = false;
    }

    function generateCaution()
    {

        $response = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/location/generate_cautions")->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            $this->refresh($errors);
            // return redirect("/location")->with("error", $this->generalError);
        } else {
            $this->showCautions = true;
            $this->cautions_link = $response["data"]["cautionpdf_path"];
        }

        // FERMETURE DES AUTRES 
        $this->show_form = false;
        // $this->showCautions = false;
        $this->show_traitFacture_form = false;
        $this->show_encaisse_form = false;
        $this->show_demenage_form = false;
    }

    function showDemenageForm($locationId)
    {
        if ($this->show_demenage_form) {
            $this->show_demenage_form = false;
        } else {
            $this->show_demenage_form = true;
        }

        $this->dispatch("demenageLocation", $locationId);
        $this->activeLocationId = $locationId;

        // FERMETURE DES AUTRES 
        $this->show_form = false;
        $this->showCautions = false;
        $this->show_traitFacture_form = false;
        $this->show_encaisse_form = false;
        // $this->show_demenage_form = false;
    }

    function showEncaisseForm($locationId)
    {
        if ($this->show_encaisse_form) {
            $this->show_encaisse_form = false;
        } else {
            $this->show_encaisse_form = true;
        }

        $this->dispatch("encaisseLocation", $locationId);
        $this->activeLocationId = $locationId;

        // FERMETURE DES AUTRES 
        $this->show_form = false;
        $this->showCautions = false;
        $this->show_traitFacture_form = false;
        // $this->show_encaisse_form = false;
        $this->show_demenage_form = false;
    }

    function Encaisse()
    {
        $data = [
            "type" => $this->encaisse_paiement_type,
            "facture" => $this->encaisse_facture,
            "location" => $this->activeLocationId,
            "mounth" => $this->encaisse_mount,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/paiement/add", $data)->json();
        // dd($response);
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("type", $errors)) {
                    $this->encaisse_paiement_type_error = $errors["type"][0];
                }

                if (array_key_exists("facture", $errors)) {
                    $this->encaisse_facture_error = $errors["facture"][0];
                }

                if (array_key_exists("mounth", $errors)) {
                    $this->encaisse_mount_error = $errors["mounth"][0];
                }

                if (array_key_exists("location", $errors)) {
                    $message = $errors;
                    $this->refresh($message);
                }
            } else {
                $message = $errors;
                $this->refresh($message);
            }
        } else {
            $successMsg = $response["message"];
            // return redirect("/location")->with("success", $successMsg);
            $this->refresh($successMsg);
        }
    }

    function FactureTraitement()
    {
        $data = [
            "status" => $this->trait_facture_status,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/facture/{$this->activeFactureId}/updateStatus", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("status", $errors)) {
                    $this->trait_facture_status_error = $errors["status"][0];
                }
            } else {
                // $this->generalError = $errors;
                $this->refresh($errors);
            }
        } else {
            $successMsg = $response["message"];
            // return redirect("/location")->with("success", $successMsg);
            $this->refresh($successMsg);
        }
    }

    function Demenage()
    {
        $data = [
            "move_comments" => $this->move_comments
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/location/{$this->activeLocationId}/demenage", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("move_comments", $errors)) {
                    $this->move_comments_error = $errors["move_comments"][0];
                }
            } else {
                $this->refresh($errors);
            }
        } else {
            $successMsg = $response["message"];
            // return redirect("/location")->with("success", $successMsg);
            $this->refresh($successMsg);
        }
    }

    function showForm()
    {

        if ($this->show_form) {
            $this->show_form = false;
        } else {
            $this->show_form = true;
        }

        // FERMETURE DES AUTRES 
        $this->showCautions = false;
        $this->show_traitFacture_form = false;
        $this->show_encaisse_form = false;
        $this->show_demenage_form = false;
    }

    function addLocation()
    {

        $data = [
            "owner" => $this->userId,
            "house" => $this->house,
            "room" => $this->room,
            "locataire" => $this->locataire,
            "type" => $this->type,
            "water_counter" => $this->water_counter,
            "electric_counter" => $this->electric_counter,
            "prestation" => $this->prestation,
            "numero_contrat" => $this->numero_contrat,
            "caution_number" => $this->caution_number,

            // "caution_bordereau" => $this->caution_bordereau,
            // "img_contrat" => $this->img_contrat,
            // "img_prestation" => $this->img_prestation,

            "caution_water" => $this->caution_water,
            "echeance_date" => $this->echeance_date,

            "latest_loyer_date" => $this->latest_loyer_date,
            "integration_date" => $this->integration_date,
            "comments" => $this->comments,
            "caution_electric" => $this->caution_electric,
        ];

        // dd($data);

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/location/add", $data)->json();
        // dd($response);
        if (!$response) {
            $this->refresh("Une erreure est survenue! Veuillez réessayer à nouveau!");
        } else {
            if (!$response["status"]) {
                $errors = $response["erros"];
                if (gettype($errors) == "array") {
                    if (array_key_exists("house", $errors)) {
                        $this->house_error = $errors["house"][0];
                    }

                    if (array_key_exists("room", $errors)) {
                        $this->room_error = $errors["room"][0];
                    }
                    if (array_key_exists("locataire", $errors)) {
                        $this->locataire_error = $errors["locataire"][0];
                    }
                    if (array_key_exists("type", $errors)) {
                        $this->type_error = $errors["type"][0];
                    }
                    if (array_key_exists("caution_bordereau", $errors)) {
                        $this->caution_bordereau_error = $errors["caution_bordereau"][0];
                    }
                    if (array_key_exists("loyer", $errors)) {
                        $this->loyer_error = $errors["loyer"][0];
                    }
                    if (array_key_exists("water_counter", $errors)) {
                        $this->water_counter_error = $errors["water_counter"][0];
                    }
                    if (array_key_exists("electric_counter", $errors)) {
                        $this->electric_counter_error = $errors["electric_counter"][0];
                    }
                    if (array_key_exists("prestation", $errors)) {
                        $this->prestation_error = $errors["prestation"][0];
                    }
                    if (array_key_exists("numero_contrat", $errors)) {
                        $this->numero_contrat_error = $errors["numero_contrat"][0];
                    }
                    if (array_key_exists("img_contrat", $errors)) {
                        $this->img_contrat_error = $errors["img_contrat"][0];
                    }
                    if (array_key_exists("caution_water", $errors)) {
                        $this->caution_water_error = $errors["caution_water"][0];
                    }

                    if (array_key_exists("electric_counter", $errors)) {
                        $this->electric_counter_error = $errors["electric_counter"][0];
                    }
                    if (array_key_exists("caution_electric", $errors)) {
                        $this->caution_electric_error = $errors["caution_electric"][0];
                    }
                    if (array_key_exists("prestation", $errors)) {
                        $this->prestation_error = $errors["prestation"][0];
                    }

                    if (array_key_exists("numero_contrat", $errors)) {
                        $this->numero_contrat_error = $errors["numero_contrat"][0];
                    }
                    if (array_key_exists("img_contrat", $errors)) {
                        $this->img_contrat_error = $errors["img_contrat"][0];
                    }
                    if (array_key_exists("caution_water", $errors)) {
                        $this->caution_water_error = $errors["caution_water"][0];
                    }
                    if (array_key_exists("electric_counter", $errors)) {
                        $this->electric_counter_error = $errors["electric_counter"][0];
                    }
                    if (array_key_exists("echeance_date", $errors)) {
                        $this->echeance_date_error = $errors["echeance_date"][0];
                    }
                    if (array_key_exists("latest_loyer_date", $errors)) {
                        $this->latest_loyer_date_error = $errors["latest_loyer_date"][0];
                    }
                    if (array_key_exists("img_prestation", $errors)) {
                        $this->img_prestation_error = $errors["img_prestation"][0];
                    }
                    if (array_key_exists("caution_number", $errors)) {
                        $this->caution_number_error = $errors["caution_number"][0];
                    }
                    if (array_key_exists("integration_date", $errors)) {
                        $this->integration_date_error = $errors["integration_date"][0];
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
                // return redirect("/location")->with("success", $successMsg);
            }
        }
    }

    public function showFactures(int $id)
    {
        $location = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/location/{$id}/retrieve")->json();
        if (!$location["status"]) {
            $this->location_factures = [];
            $this->current_location = [];
        } else {
            $this->location_factures = $location["data"]["factures"];
            $this->current_location = $location["data"];
        }

        // FERMETURE DES AUTRES 
        // FERMETURE DES AUTRES 
        $this->show_form = false;
        $this->showCautions = false;
        // $this->show_traitFacture_form = false;
        $this->show_encaisse_form = false;
        $this->show_demenage_form = false;
    }

    public function showFacturesTraitementForm($factureId)
    {
        if ($this->show_traitFacture_form) {
            $this->show_traitFacture_form = false;
        } else {
            $this->show_traitFacture_form = true;
        }

        $this->activeFactureId = $factureId;

        // FERMETURE DES AUTRES 
        $this->show_form = false;
        $this->showCautions = false;
        // $this->show_traitFacture_form = false;
        $this->show_encaisse_form = false;
        $this->show_demenage_form = false;
    }

    public function delete(int $id)
    {
        $response = Http::withHeaders($this->hearders)->delete($this->BASE_URL . "immo/locataire/{$id}/delete")->json();

        if (!$response["status"]) {
            // return redirect("/location")->with("error", $response["erros"]);
            $this->refresh($response["erros"]);
        }else {
            $this->refresh($response["message"]);
        }
        // return redirect("/location")->with("success", $response["message"]);
    }
    public function render()
    {
        return view('livewire.location');
    }
}
