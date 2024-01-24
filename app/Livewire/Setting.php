<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setting extends Component
{
    use WithFileUploads;

    public $users = [];

    public $BASE_URL = "";
    public $token = "";
    public $userId;

    public $hearders = [];

    public $current_locationId = [];

    public $generalError = "";

    // LES DATAS
    public $name;
    public $username;
    public $phone;
    public $email;

    public $role;


    // LES ERREURES
    public $name_error = "";
    public $username_error = "";
    public $phone_error = "";
    public $email_error = "";

    public $role_error = "";

    // 
    public $showAddForm = true;
    public $showUserRoles = false;

    public $showRoleForm = false;

    public $currentActiveUserId;
    public $currentActiveUser = [];

    public $currentUserRoles = [];

    public $allRoles = [];


    function __construct()
    {
        $this->BASE_URL = env("BASE_URL");
        // session()->forget("token");
        $this->token = session()->get("token");
        $this->userId = session()->get("userId");

        $this->hearders = [
            "Authorization" => "Bearer " . $this->token,
        ];

        // USERS
        $users = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/users")->json();
        if (!$users["status"]) {
            $this->users = [];
            return redirect("/")->with("error","Vous n'êtes pas connecté!");

        } else {
            $this->users = $users["data"];
        }

        // ROLES
        $roles = Http::withHeaders($this->hearders)->get($this->BASE_URL . "role/all")->json();
        if (!$roles["status"]) {
            $this->allRoles = [];
            return redirect("/")->with("error","Vous n'êtes pas connecté!");

        } else {
            $this->allRoles = $roles["data"];
        }
    }

    function ShowAddForm()
    {
        $this->generalError = "";

        if (!$this->showAddForm) {
            $this->showAddForm = true;
        } else {
            $this->showAddForm = false;
        }
        $this->showUserRoles = false;
        $this->showRoleForm = false;
    }

    function ShowAffectRoleForm($id)
    {
        $this->generalError = "";

        $this->currentActiveUserId = $id;
        $user = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/users/$id")->json();
        if (!$user["status"]) {
            $this->currentActiveUser = [];
        }else {
            $this->currentActiveUser = $user["data"];
        }

        if (!$this->showRoleForm) {
            $this->showRoleForm = true;
        } else {
            $this->showRoleForm = false;
        }
        $this->showAddForm = false;
        $this->showUserRoles = false;

    }

    function AffectRole()
    {
        $data = [
            "user_id" => $this->currentActiveUserId,
            "role_id" => $this->role,
        ];
        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "role/attach-user", $data)->json();
        // dd($response);
        if ($response) {
            if (!$response["status"]) {
                $errors = $response["erros"];
                $this->generalError = $errors;
                $this->refreshRoles();
                // return redirect("/setting")->with("error", $this->generalError);
            } else {
                // $successMsg = $response["message"];
                // return redirect("/setting")->with("success", $successMsg);
                $this->generalError = $response["message"];
                $this->refreshRoles();
            }
        } else {
            // return redirect("/setting")->with("success", "Une erreure est survenue! Veuillez bien réessayer!");
            $this->generalError = "Une erreure est survenue! Veuillez bien réessayer!";
            $this->refreshRoles();
        }
    }

    function Archiver($id)
    {
        $response = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/$id/archive")->json();
        if ($response) {
            if (!$response["status"]) {
                $errors = $response["erros"];
                $this->generalError = $errors;
                $this->refreshUsers();
                // return redirect("/setting")->with("error", $this->generalError);
            } else {
                // $successMsg = $response["message"];
                // return redirect("/setting")->with("success", $successMsg);
                $this->generalError = $response["message"];
                $this->refreshUsers();
            }
        } else {
            // return redirect("/setting")->with("success", "Une erreure est survenue! Veuillez bien réessayer!");
            $this->generalError = "Une erreure est survenue! Veuillez bien réessayer!";
            $this->refreshUsers();
        }
    }

    function Dupliquer($id)
    {
        $response = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/$id/duplicate")->json();
        // dd($response);
        if ($response) {
            if (!$response["status"]) {
                $errors = $response["erros"];
                $this->generalError = $errors;
                $this->refreshUsers();
                // return redirect("/setting")->with("error", $this->generalError);
            } else {
                // $successMsg = $response["message"];
                // return redirect("/setting")->with("success", $successMsg);
                $this->generalError = $response["message"];
                $this->refreshUsers();
            }
        } else {
            // return redirect("/setting")->with("success", "Une erreure est survenue! Veuillez bien réessayer!");
            $this->generalError = "Une erreure est survenue! Veuillez bien réessayer!";
            $this->refreshUsers();
        }
    }

    function seeRoles($userId)
    {
        // USERS
        $this->generalError = "";
        $this->currentActiveUserId = $userId;
        $user = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/users/$userId")->json();
        $this->currentUserRoles = $user["data"]["roles"];
        $this->currentActiveUser = $user["data"];
        if (!$this->showUserRoles) {
            $this->showUserRoles = true;
        } else {
            $this->showUserRoles = false;
        }

        $this->showRoleForm = false;
        $this->showAddForm = false;

    }

    function refreshUsers()
    {
        $users = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/users")->json();
        if (!$users["status"]) {
            $this->users = [];
            return redirect("/")->with("error","Vous n'êtes pas connecté!");

        } else {
            $this->users = $users["data"];
        }
        

        $this->name_error = "";
        $this->username_error = "";
        $this->phone_error = "";
        $this->email_error = "";

        $this->showAddForm = false;
    }

    function refreshRoles()
    {
        $user = Http::withHeaders($this->hearders)->get($this->BASE_URL . "user/users/$this->currentActiveUserId")->json();
        if (!$user["status"]) {
            $this->currentUserRoles = [];
            return redirect("/")->with("error","Vous n'êtes pas connecté!");
        }else {
            $this->currentUserRoles = $user["data"]["roles"];
        }


        $this->name_error = "";
        $this->username_error = "";
        $this->phone_error = "";
        $this->email_error = "";

        $this->showAddForm = false;
    }

    function remove($roleId)
    {
        $data = [
            "user_id" => $this->currentActiveUserId,
            "role_id" => $roleId,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "role/desattach-user", $data)->json();
        // dd($response);

        if ($response) {
            if (!$response["status"]) {
                if (array_key_exists("erros", $response)) {
                    $this->generalError = $response["erros"];
                }
            } else {
                $this->generalError = $response["message"];

                $this->refreshRoles();
                // $successMsg = $response["message"];
                // return redirect("/setting")->with("success", $successMsg);
            }
        } else {
            $this->generalError = "Une erreure est survenue! Veuillez éssayer à nouveau";
        }

        // $this->showUserRoles = false;
        $this->showAddForm = false;
    }


    function addUser()
    {
        $data = [
            "owner" => $this->userId,
            "name" => $this->name,
            "username" => $this->username,
            "email" => $this->email,
            "phone" => $this->phone,
        ];

        $response = Http::withHeaders($this->hearders)->post($this->BASE_URL . "user/add", $data)->json();
        if ($response) {
            if (!$response["status"]) {
                $errors = $response["erros"];
                if (gettype($errors) == "array") {
                    if (array_key_exists("name", $errors)) {
                        $this->name_error = $errors["name"][0];
                    }

                    if (array_key_exists("username", $errors)) {
                        $this->username_error = $errors["username"][0];
                    }
                    if (array_key_exists("phone", $errors)) {
                        $this->phone_error = $errors["phone"][0];
                    }
                    if (array_key_exists("email", $errors)) {
                        $this->email_error = $errors["email"][0];
                    }
                } else {
                    $this->generalError = "Une erreure est survenue";
                    // return redirect("/setting")->with("success", $this->generalError);
                }
            } else {
                // $successMsg = $response["message"];
                // return redirect("/setting")->with("success", $successMsg);

                // $this->refreshRoles();
                $this->refreshUsers();
                $this->generalError = $response["message"];
            }
        } else {
            $this->refreshRoles();
            $this->refreshUsers();
            $this->generalError = "Une erreure est survenue! Veuillez bien réessayer!";
        }
    }

    public function render()
    {
        return view('livewire.setting');
    }
}
