<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class EventAanmeldController extends Controller
{
    public function zieAangelemdeEvents(Request $request)
    {
        $user = auth()->user();

        $today = Carbon::today();

        $locatieEventVandaag = $user->events()->whereDate('event_date', '=', $today)->first();

        if ($locatieEventVandaag) {
            $location = $locatieEventVandaag->event_locatie;
        } else {
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


        // Toekomstige events (vanaf morgen)
        $aangemeldenEventData = $user->events()
            ->whereDate('event_date', '>', $today)
            ->orderBy('event_date', 'asc')
            ->get();

        // Events van vandaag
        $vandaagEventData = $user->events()
            ->whereDate('event_date', '=', $today)
            ->orderBy('event_date', 'asc')
            ->get();

        // Verleden events (voor vandaag)
        $geweestEventData = $user->events()
            ->whereDate('event_date', '<', $today)
            ->orderBy('event_date', 'asc')
            ->get();

        return view('aangemeldenEvent', [
            'weather' => $weather,
            'aangemeldenEventData' => $aangemeldenEventData,
            'geweestEventData' => $geweestEventData,
            'vandaagEventData' => $vandaagEventData,
        ]);
    }

    public function aanmeldEvent(Request $request)
    {
        $request->validate([
        'event_id' => 'required|exists:event_data,idevent_data',
    ]);

    $user = Auth::user();
    $eventId = $request->input('event_id');

    if ($user->events()->where('event_data_idevent_data', $request->idevent_data)->exists()) {
        return back()->with('error', 'Je bent al aangemeld voor dit event.');
    }

    $user->events()->attach($eventId);

    return redirect()->back();
    }
}