<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function signup(Request $request)
    {
        // dd('signup functie werkt');

        $validated = $request->validate([
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'leeftijd' => 'required|date|max:255',
            'locatie' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['voornaam'],
            'lastname' => $validated['achternaam'],
            'email' => $validated['email'],
            'age' => $validated['leeftijd'],
            'locatie' => $validated['locatie'],
            'password' => Hash::make($validated['password']),
        ]);

        // Auto-login the user
        auth()->login($user);

        return redirect('/home')->with('success', 'Je bent succesvol geregistreerd!');
    }
}
?>