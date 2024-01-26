<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{
    public $account_error = "";
    public $password_error = "";

    public $account = "";
    public $password = "";

    public $generalError = "";


    function Login()
    {
        $BASE_URL = env("BASE_URL");

        $data = [
            "account" => $this->account,
            "password" => $this->password
        ];

        $response = Http::post($BASE_URL . "user/login", $data)->json();
        if (!$response["status"]) {
            $errors = $response["erros"];
            if (gettype($errors) == "array") {
                if (array_key_exists("account", $errors)) {
                    $this->account_error = $errors["account"][0];
                }
                if (array_key_exists("password", $errors)) {
                    $this->password = $errors["password"][0];
                }
            } else {
                $this->generalError = $errors;
            }
        } else {
            $token = $response["data"]["token"];
            $userId = $response["data"]["id"];
            $user = $response["data"];

            $successMsg = $response["message"];

            session()->put("token", $token);
            session()->put("userId", $userId);
            session()->put("user", $user);


            return redirect("/dashbord")->with("success", $successMsg);
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
