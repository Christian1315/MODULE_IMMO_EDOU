<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountSold extends Component
{
    use WithFileUploads;

    public $accounts = [];
    public $accounts_count = [];


    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $account_solds = [];
    public $current_account = [];


    // creadited account DATAS
    public $sold = "";
    public $comments = "";

    // TRAITEMENT DES ERREURS
    public $sold_error = "";
    public $comments_error = "";

    public $generalError = "";
    // 
    public $show_form = false;
    public $show_solds = false;

    public $currentActiveAccount;

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
        // account
        $accounts = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/account/all")->json();
        if (!$accounts["status"]) {
            $this->accounts = [];
            $this->accounts_count = [];
        } else {
            $this->accounts = $accounts["data"];
            $this->accounts_count = count($accounts["data"]);
        }
    }

    function refresh($message)
    {
        $this->generalError = $message;
        // account
        $accounts = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/account/all")->json();
        if (!$accounts["status"]) {
            $this->accounts = [];
            $this->accounts_count = [];
        }else {
            $this->accounts = $accounts["data"];
            $this->accounts_count = count($accounts["data"]);
        }

        $this->show_form = false;
        $this->show_solds = false;
        $this->sold_error = "";
        $this->comments_error = "";
    }

    function showForm(int $id)
    {

        $this->currentActiveAccount = $id;
        if ($this->show_form) {
            $this->show_form = false;
            $this->show_solds = false;
        } else {
            $this->show_form = true;
            $this->show_solds = false;
        }
    }

    function addSold()
    {

        $data = [
            "sold" => $this->sold,
            "description" => $this->comments,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "immo/account/sold/$this->currentActiveAccount/creditate", $data)->json();
        // dd($response);
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("sold", $errors)) {
                    $this->sold_error = $errors["sold"][0];
                }

                if (array_key_exists("description", $errors)) {
                    $this->comments_error = $errors["description"][0];
                }
            } else {
                // $this->generalError = $errors;
                $this->refresh($errors);
            }
        } else {
            $successMsg = $response["message"];
            // return redirect("/count")->with("success", $successMsg);
            $this->refresh($successMsg);
        }
    }

    public function showSolds(int $id)
    {
        $account = Http::withHeaders($this->hearders)->get($this->BASE_URL . "immo/account/{$id}/retrieve")->json();
        if (!$account["status"]) {
            $this->account_solds = [];
            $this->current_account = [];
        }else {
            $this->account_solds = $account["data"]["solds"];
            $this->current_account = $account["data"];
        }

        if ($this->show_solds) {
            $this->current_account = [];
            $this->show_solds = false;
            $this->show_form = false;
        } else {
            $this->show_solds = true;
            // $this->current_account = $account["data"];
            $this->show_form = false;
        }
    }
}
