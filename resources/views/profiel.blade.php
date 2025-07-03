<x-layout :h1="'Profiel'">
    {{-- 
    hier komt CRUD gedeelte je kan all je gegevens inzien, updaten en je account verwijderen.
    --}}

    @if (isset($userData))
    <div class="bg-blue-100 p-4 rounded mb-6">
        <p>voornaam: {{ $userData['voornaam'] }}</p>
        <p>achternaam: {{ $userData['achternaam'] }}</p>
        <p>geboortedatum: {{ $userData['leeftijd'] }}</p>
        <p>email: {{ $userData['email'] }}</p>
        <p>woonplaats: {{ $userData['locatie'] }}</p>
    </div>
    @endif

    <div class="bg-blue-100 p-4 rounded mb-6">
        <fieldset>
            <h2 class="text-lg font-bold">profiel aanpassen</h2>
            <form action="/profiel/update-email" method="POST">
                @csrf
                <label for="emailUpdate">email aanpassen:</label>
                <input name="emailUpdate" type="text" class="border-2 border-solid border-gray-400 px-4 py-2 rounded">

                <input type="submit" value="pass aan" class="border-2 border-solid border-gray-400 px-4 py-2 rounded hover:bg-gray-500 hover:text-white">
            </form><br>

            <form action="/profiel/update-location" method="POST">
                @csrf
                <label for="locatieUpdate">woonplaats aanpassen:</label>
                <input name="locatieUpdate" type="text" class="border-2 border-solid border-gray-400 px-4 py-2 rounded">

                <input type="submit" value="pass aan" class="border-2 border-solid border-gray-400 px-4 py-2 rounded hover:bg-gray-500 hover:text-white">
            </form><br>

            <form action="/profiel/update-password" method="POST">
                @csrf
                <label for="password">Nieuwe wachtwoord:</label>
                <input name="password" type="password" class="border-2 border-solid border-gray-400 px-4 py-2 rounded"><br>

                <label for="password_confirmation">herhaal wachtwoord:</label>
                <input name="password_confirmation" type="password" class="border-2 border-solid border-gray-400 px-4 py-2 rounded">

                <input type="submit" value="pass aan" class="border-2 border-solid border-gray-400 px-4 py-2 rounded hover:bg-gray-500 hover:text-white">
            </form><br><br><br><br><br>

            <form action="/profiel/Delete" method="POST">
                @csrf
                <input type="submit" value="Delete account" class="border-2 border-solid border-gray-400 px-4 py-2 rounded hover:bg-gray-500 hover:text-white">
            </form>
        </fieldset>
    </div>
</x-layout>