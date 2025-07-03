<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class weerController extends Controller
{
    public function hetWeer()
    {
        $apiKey = env('WEER_API_KEY');
        $user = auth()->user();
        $location = $user->locatie ?? 'Amsterdam';

        $response = Http::get("https://weerlive.nl/api/weerlive_api_v2.php", [
            'key' => $apiKey,
            'locatie' => $location
        ]);

        if ($response->successful()) {
            $data = $response->json();

            // Debug the structure if needed
            //dd($data);

            if (isset($data['liveweer']) && is_array($data['liveweer']) && isset($data['liveweer'][0])) {
                $weather = $data['liveweer'][0];
                return view('home', compact('weather'));
            } else {
                return view('home', ['error' => 'Weerdata niet gevonden.']);
            }
        }

        return view('home', ['error' => 'Fout bij het ophalen van het weer.']);
    }
}