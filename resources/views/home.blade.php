<?php
    use Illuminate\Support\Facades\Auth;
?>

<x-layout :h1="'Dashboard'">
    @if (isset($weather))
    <div class="bg-blue-100 p-4 rounded mb-6">
        <h2 class="text-lg font-bold">Weer in {{ $weather['plaats'] }}</h2>
        <p>Temperatuur: {{ $weather['temp'] }}°C</p>
        <p>Verwachting: {{ $weather['verw'] }}</p>
        <p>Wind: {{ $weather['windr'] }} - {{ $weather['windkmh'] }} km/u</p>
    </div>
    @elseif (isset($error))
        <div class="text-red-500">{{ $error }}</div>
    @endif

<div class="bg-blue-100 p-4 rounded mb-6">
    <form action="/home" method="POST"> 
        @csrf
        <h2 class="text-lg font-bold">zoek op locatie en datum</h2>
        <label for="zoekNaam">event naam:</label>
        <input type="text" name="zoekNaam" class="border-2 border-solid border-gray-400 px-4 py-2 rounded">

        <label for="zoekLocatie">Locatie:</label>
        <select name="zoekLocatie" class="border-2 border-solid border-gray-400 px-4 py-2 rounded">
            <option value="">-</option>
            <option value="Amsterdam">Amsterdam</option>
            <option value="Rotterdam">Rotterdam</option>
            <option value="Utrecht">Utrecht</option>
            <option value="Eindhoven">Eindhoven</option>
            <option value="Groningen">Groningen</option>
            <option value="Arnhem">Arnhem</option>
            <option value="Den Haag">Den Haag</option>
            <option value="Maastricht">Maastricht</option>
            <option value="Leeuwarden">Leeuwarden</option>
            <option value="Tilburg">Tilburg</option>
            <option value="Almere">Almere</option>
        </select>

        <label for="zoekDate">kies een datum:</label>
        <input type="date" name="zoekDate" class="border-2 border-solid border-gray-400 px-4 py-2 rounded">

        <input type="submit" value="Zoek" class="border-2 border-solid border-gray-400 px-4 py-2 rounded hover:bg-gray-500 hover:text-white">
    </form><br>
</div>

    <div class="block max-h-80 overflow-y-auto">
        <ul>
            @foreach ($events as $event)
                <fieldset class="bg-blue-100 p-4 rounded mb-6">
                    <li>
                        {{ $event->event_name }} - {{ $event->event_date }} - {{ $event->event_locatie }}

                        <?php
                            $user = Auth::user();
                            $alAangemeld = $user && $user->events->contains($event->idevent_data);
                            $isToekomst = \Carbon\Carbon::parse($event->event_date)->isFuture();
                        ?>

                        @if ($isToekomst && !$alAangemeld)
                            <form action="/aangemeldenEvent" method="POST">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->idevent_data }}">
                                <input type="submit" value="Aanmelden" class="border-2 border-solid border-gray-400 px-4 py-2 rounded hover:bg-gray-500 hover:text-white">
                            </form>
                        @elseif ($alAangemeld)
                            <span class="text-green-600">✔ Je bent al aangemeld</span>
                        @else
                            <span class="text-gray-500"> (Niet beschikbaar)</span>
                        @endif
                    </li>
                </fieldset>
            @endforeach
        </ul>
    </div>
</x-layout>

{{-- https://weerlive.nl/api/weerlive_api_v2.php?key=8ad557d6d2&locatie=Almere --}}