<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware(['LoginOrNot']);
    }

    function Admin(Request $request)
    {
        return view("admin.dashboard");
    }

    function Proprietor(Request $request)
    {
        return view("admin.proprietors");
    }
    function House(Request $request)
    {
        return view("admin.houses");
    }
    function Client(Request $request)
    {

        return view("admin.clients");
    }
    function Room(Request $request)
    {
        return view("admin.rooms");
    }
    function Locator(Request $request)
    {
        return view("admin.locataires");
    }
    function Location(Request $request)
    {
        return view("admin.locations");
    }
    function AccountSold(Request $request)
    {
        return view("admin.count_solds");
    }
    function Initiation(Request $request)
    {
        return view("admin.initiations");
    }
    function Paiement(Request $request)
    {
        return view("admin.paiements");
    }

    function Setting(Request $request)
    {
        return view("admin.settings");
    }
    function Statistique(Request $request)
    {
        return view("admin.statistiques");
    }

    function StopHouseState(Request $request, $id)
    {
        $BASE_URL = env("BASE_URL");
        $token = session()->get("token");
        $userId = session()->get("userId");

        $hearders = [
            "Authorization" => "Bearer " . $token,
        ];

        // les locations de cette maison
        $response = Http::withHeaders($hearders)->get($BASE_URL . "immo/house/{$id}/retrieve")->json();
        if (!$response["status"]) {
            return redirect()->back()->with("error", $response["erros"]);
        }

        // LES ETATS DE CETTE MAISON
        $res = Http::withHeaders($hearders)->get($BASE_URL . "immo/house_state/house/{$id}/all")->json();
        if (!$response["status"]) {
            return redirect()->back()->with("error", $response["erros"]);
        }
        $states = $res["data"];
        // dd($states);
        $house = $response["data"];
        $locations = $house["locations"];
        // dd($locations);
        return view("admin.stop-house-state", compact(["house", "locations", "states"]));
    }

    function StopState(Request $request, $id)
    {
        $BASE_URL = env("BASE_URL");
        $token = session()->get("token");
        $userId = session()->get("userId");

        $hearders = [
            "Authorization" => "Bearer " . $token,
        ];

        $data = [
            "house" => $id,
        ];

        // dd($id);
        // les locations de cette maison
        $response = Http::withHeaders($hearders)->post($BASE_URL . "immo/house_state/stop", $data)->json();
        if (!$response["status"]) {
            return redirect()->back()->with("error", $response["erros"]);
        } else {
            return redirect()->back()->with("success", $response["message"]);
        }
    }

    function LocationFactures(Request $request, $location)
    {
        $BASE_URL = env("BASE_URL");
        $token = session()->get("token");
        $userId = session()->get("userId");

        $hearders = [
            "Authorization" => "Bearer " . $token,
        ];

        // les locations de cette maison
        $response = Http::withHeaders($hearders)->get($BASE_URL . "immo/location/{$location}/retrieve")->json();
        if (!$response["status"]) {
            return redirect()->back()->with("error", $response["erros"]);
        }

        $location = $response["data"];
        $factures = $location["factures"];

        return view("admin.factures", compact(["location", "factures"]));
    }
}
