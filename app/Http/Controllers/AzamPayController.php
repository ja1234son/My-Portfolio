<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AzamPayController extends Controller
{
    public function checkout(Request $request){
       $cart = $request->cart;
       $total = $request->total;

       $token = $this->getToken();

       $response =Http::withHeaders([
         'Authorization' => 'Bearer ' . $token,
         'Content-Type' => 'application/json',
       ])->post('https://sandbox.azampay.co.tz/azampay/mno/checkout',[
          "accountNumber" => "2550651286663",
          "amount" => $total,
          "currency" => "TZS",
          "externalId" => uniqid(),
          "provider" => "Tigo"
       ]);
        return response()->json($response->json());
    }

    private function getToken(){
        $response = Http::post('https://authenticator-sandbox.azampay.co.tz/AppRegistration/GenerateToken',[
            "appName" => env('AZAM_APP_NAME'),
           "clientId" => env('AZAM_CLIENT_ID'),
            "clientSecret" => env('AZAM_CLIENT_SECRET')
        ]);
         return $response['data']['accessToken'];
    }
}
