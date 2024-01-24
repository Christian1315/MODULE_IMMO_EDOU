<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Paiement extends Component
{
    use WithFileUploads;

    public $paiements = [];
    public $paiements_count = [];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $paiement_solds = [];
    public $current_paiement = [];
    public $proprietors = [];
    public $paiement_status = [];


    // creadited paiement DATAS
    public $status = "";

    // TRAITEMENT DES ERREURS
    public $status_error = "";

    public $generalError = "";
    // 
    public $show_form = true;
    public $show_solds = false;

    // search by period
    public $start_date;
    public $end_date;

    public $start_date_error;
    public $end_date_error;

    public $currentActivepaiement = null;

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

        // paiement
        $paiements = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/all")->json();
        if (!$paiements["status"]) {
            $this->paiements = [];
            $this->paiements_count = 0;
        } else {
            $this->paiements = $paiements["data"];
            $this->paiements_count = count($paiements["data"]);
        }

        // PROPRIETAIRES
        $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors = [];
        } else {
            $this->proprietors = $proprietors["data"];
        }

        // STATUS
        $paiement_status = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/status/all")->json();
        if (!$paiement_status["status"]) {
            $this->paiement_status = [];
        } else {
            $this->paiement_status = $paiement_status["data"];
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;

        // paiement
        $paiements = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/all")->json();
        if (!$paiements["status"]) {
            $this->paiements = [];
            $this->paiements_count = 0;
        } else {
            $this->paiements = $paiements["data"];
            $this->paiements_count = count($paiements["data"]);
        }

        // PROPRIETAIRES
        $proprietors = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/proprietor/all")->json();
        if (!$proprietors["status"]) {
            $this->proprietors = [];
        } else {
            $this->proprietors = $proprietors["data"];
        }

        // STATUS
        $paiement_status = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/status/all")->json();
        if (!$paiement_status["status"]) {
            $this->paiement_status = [];
        } else {
            $this->paiement_status = $paiement_status["data"];
        }
    }

    function validate_paiement($id)
    {
        $response = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/payement_paiement/$id/valide")->json();
        if (!$response["status"]) {
            if (array_key_exists("erros", $response)) {
                $message = $response["erros"];
            }

            if (array_key_exists("message", $response)) {
                $message = $response["message"];
            }
            $this->refresh($message);
            // return redirect("/paiement")->with("success", $this->generalError);
        } else {
            $successMsg = $response["message"];
            // return redirect("/paiement")->with("success", $successMsg);
            $this->generalError = $response["message"];
            $this->refresh($successMsg);
        }
    }

    function searchByDate()
    {
        $data = [
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
        ];
        // dd($data);
        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/paiement/filtre_by_date", $data)->json();

        // dd($response);
        if (!$response["status"]) {
            if (array_key_exists("erros", $response)) {
                $message = $response["erros"];
                $this->refresh($message);
            }

            if (array_key_exists("start_date", $response)) {
                $this->start_date_error = $response["start_date"];
            }

            if (array_key_exists("end_date", $response)) {
                $this->end_date_error = $response["end_date"];
            }
        } else {
            $successMsg = $response["message"];
            $this->paiements = $response["data"];
            $this->generalError = $successMsg;
        }
    }

    function showForm($id)
    {
        if ($this->show_form) {
            $this->show_form = false;
            $this->show_solds = false;
        } else {
            $this->show_form = true;
            $this->show_solds = false;
        }
        // dd($id);
        $this->currentActivepaiement = $id;
    }


    function TraitePaiement()
    {

        $data = [
            "status" => $this->status,
        ];

        if (!$this->status) {
            // $this->generalError =
            $this->refresh("Le status est réquis!");
            // return redirect("/paiement")->with("error", "Le status est réquis!");
        }

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/paiement/$this->currentActivepaiement/update", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("status", $errors)) {
                    $this->status_error = $errors["status"][0];
                }
            } else {
                $message = $errors;
                $this->refresh($message);
            }
        } else {
            $successMsg = $response["message"];
            // return redirect("/paiement")->with("success", $successMsg);
            $this->refresh($successMsg);
        }
    }

    public function showSolds(int $id)
    {
        $paiement = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/paiement/{$id}/retrieve")->json();
        if (!$paiement["status"]) {
            $this->paiement_solds = [];
            $this->current_paiement = [];
        } else {
            $this->paiement_solds = $paiement["data"]["solds"];
            $this->current_paiement = $paiement["data"];
        }

        if ($this->show_solds) {
            $this->current_paiement = [];
            $this->show_solds = false;
            $this->show_form = false;
        } else {
            $this->show_solds = true;
            $this->current_paiement = $paiement["data"];
            $this->show_form = false;
        }
    }

    public function render()
    {
        return view('livewire.paiement');
    }
}
