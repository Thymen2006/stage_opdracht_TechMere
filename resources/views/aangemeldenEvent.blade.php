<x-layout :h1="'events waar je bent aangemeld'">

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

<div class="flex justify-between px-4 space-x-8">
    <fieldset class="bg-blue-100 p-4 rounded mb-6 w-2/6 border p-4 block max-h-64 overflow-y-auto">
        <h2 class="text-lg font-bold">waar je bent geweest:</h2>
        @if(isset($geweestEventData) && $geweestEventData instanceof \Illuminate\Support\Collection && $geweestEventData->count())
            <ul>
                @foreach ($geweestEventData as $event)
                    <li><span class="font-bold">{{ $event->event_name }}</span> - {{ $event->event_date }} - {{ $event->event_locatie }}</li><br>
                @endforeach
            </ul>
        @else
            <p>Geen evenementen gevonden.</p>
        @endif
    </fieldset>

    <fieldset class="bg-blue-100 p-4 rounded mb-6 w-2/6 border p-4 block max-h-64 overflow-y-auto">
        <h2 class="text-lg font-bold">vandaag:</h2>
        @if(isset($vandaagEventData) && $vandaagEventData instanceof \Illuminate\Support\Collection && $vandaagEventData->count())
            <ul>
                @foreach ($vandaagEventData as $event)
                    <li><span class="font-bold">{{ $event->event_name }}</span> - {{ $event->event_date }} - {{ $event->event_locatie }}</li><br>
                @endforeach
            </ul>
        @else
            <p>Geen evenementen gevonden.</p>
        @endif
    </fieldset>

    <fieldset class="bg-blue-100 p-4 rounded mb-6 w-2/6 border p-4 block max-h-64 overflow-y-auto">
        <h2 class="text-lg font-bold">je bent aangemeld voor:</h2>
        @if(isset($aangemeldenEventData) && $aangemeldenEventData instanceof \Illuminate\Support\Collection && $aangemeldenEventData->count())
            <ul>
                @foreach ($aangemeldenEventData as $event)
                    <li><span class="font-bold">{{ $event->event_name }}</span> - {{ $event->event_date }} - {{ $event->event_locatie }}</li><br>
                @endforeach
            </ul>
        @else
            <p>Geen evenementen gevonden.</p>
        @endif
    </fieldset>
</div>
</x-layout>