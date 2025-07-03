<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfielController extends Controller
{
    public function ProfielUpdateEmail(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'emailUpdate' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->email = $request->input('emailUpdate');
        $user->save();

        return redirect()->back()->with('success', 'Email succesvol bijgewerkt!');
    }

    public function ProfielUpdateLocation(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'locatieUpdate' => 'required|string|max:255' . $user->id,
        ]);

        $user->locatie = $request->input('locatieUpdate');
        $user->save();

        return redirect()->back()->with('success', 'woonplaats succesvol bijgewerkt!');
    }
    

    public function ProfielUpdatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = $request->input('password');
        $user->save();

        return redirect()->back()->with('success', 'wachtwoord succesvol bijgewerkt!');
    }



    public function ProfielDelete(Request $request)
    {
        $user = auth()->user();
        $user->delete();
        Auth::logout();

        return redirect('/');
    }
    public function ProfielRead(Request $request)
    {
        $user = auth()->user();

        $userData = [
            'locatie' => $user->locatie,
            'voornaam' => $user->name,
            'achternaam' => $user->lastname,
            'email' => $user->email,
            'leeftijd' => $user->age,
        ];

        return view('profiel', ['userData' => $userData]);
    }
}