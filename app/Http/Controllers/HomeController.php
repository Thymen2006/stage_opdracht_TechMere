<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Event;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function GetHomeData()
    {
    $today = Carbon::today();

    $user = auth()->user();
    $location = $user->locatie;
    $apiKey = env('WEER_API_KEY');

    $response = Http::get("https://weerlive.nl/api/weerlive_api_v2.php", [
        'key' => $apiKey,
        'locatie' => $location,
    ]);

    $weather = null;
    if ($response->successful()) {
        $data = $response->json();
        if (isset($data['liveweer'][0])) {
            $weather = $data['liveweer'][0];
        } else {
            $weather = ['fout' => 'Geen weerdata gevonden.'];
        }
    } else {
        $weather = ['fout' => 'Weer API mislukt.'];
    }

    $events = Event::whereDate('event_date', '>', $today)
    ->orderBy('event_date', 'asc')
    ->get();

    return view('home', [
        'weather' => $weather,
        'events' => $events,
    ]);
    }

    public function zoekEvent(Request $request)
    {
        $today = Carbon::today();
        
        $request->validate([
            'zoekNaam' => 'nullable|string|max:255',
            'zoekLocatie' => 'nullable|string|max:255',
            'zoekDate' => 'nullable|date',
        ]);

        $zoekNaam = $request->input('zoekNaam');
        $zoekLocatie = $request->input('zoekLocatie');
        $zoekDate = $request->input('zoekDate');

        $query = Event::query();

        if ($zoekNaam) {
            $query->where('event_name', 'LIKE', "%{$zoekNaam}%");
        }

        if ($zoekLocatie) {
            $query->where('event_locatie', 'LIKE', "%{$zoekLocatie}%")->whereDate('event_date', '>', $today);
        }

        if ($zoekDate) {
            $query->whereDate('event_date', $zoekDate);
        }

        $events = $query->orderBy('event_date', 'asc')->get();



        if(!empty($zoekLocatie)){
            $location = $zoekLocatie;
        }else{
            $user = auth()->user();
            $location = $user->locatie;
        }
        $apiKey = env('WEER_API_KEY');

        $response = Http::get("https://weerlive.nl/api/weerlive_api_v2.php", [
            'key' => $apiKey,
            'locatie' => $location,
        ]);

        $weather = null;
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['liveweer'][0])) {
                $weather = $data['liveweer'][0];
            } else {
                $weather = ['fout' => 'Geen weerdata gevonden.'];
            }
        } else {
            $weather = ['fout' => 'Weer API mislukt.'];
        }

        return view('home', [
            'events' => $events,
            'weather' => $weather,
        ]);
    }
}