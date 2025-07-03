<?php
?>
<x-layout-login>
    <form class="space-y-6" action="/registreer" method="POST">
        @csrf
        <div>
            <label for="voornaam" class="block text-sm/6 font-medium text-gray-900">Voornaam</label>
            <div class="mt-2">
            <input type="text" name="voornaam" id="voornaam" placeholder="Bert" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>
        <div>
            <label for="achternaam" class="block text-sm/6 font-medium text-gray-900">Achternaam</label>
            <div class="mt-2">
            <input type="text" name="achternaam" id="achternaam" placeholder="de Berg" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>
        <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <div class="mt-2">
            <input type="email" name="email" id="email" autocomplete="email" placeholder="meldJeAan@gmail.com" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>

        <div>
            <label for="leeftijd" class="block text-sm/6 font-medium text-gray-900">Leeftijd</label>
            <div class="mt-2">
            <input type="date" name="leeftijd" id="leeftijd" placeholder="18" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>
        <div>
            <label for="locatie" class="block text-sm/6 font-medium text-gray-900">jouw locatie</label>
            <div class="mt-2">
            <input type="text" name="locatie" id="locatie" placeholder="Amsterdam" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Wachtwoord</label>
            </div>
            <div class="mt-2">
            <input type="password" name="password" id="password" placeholder="Hallo1234" minlength="8" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between">
            <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Herhaal Wachtwoord</label>
            </div>
            <div class="mt-2">
            <input type="password" name="password_confirmation" id="password" placeholder="Hallo1234" minlength="8" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
        </div>
        @if ($errors->any())
    <script>
        alert("{{ implode('\n', $errors->all()) }}");
    </script>
@endif
        </form>
        <p class="mt-10 text-center text-sm/6 text-gray-500">
        al een account
        <a href="/" class="font-semibold text-indigo-600 hover:text-indigo-500">log hier in</a>
        </p>
</x-layout-login>