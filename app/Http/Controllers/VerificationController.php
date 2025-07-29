<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

class VerificationController extends Controller
{
    public function showForm()
    {
        return view('auth.verify-code');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $user = Auth::user();

        // Récupération du nombre de tentatives depuis la session, 0 par défaut
        $attempts = session()->get('code_attempts', 0);

        // Si le code est correct
        if ($user->verification_code === $request->code) {
            $user->is_verified = true;
            $user->verification_code = null;
            $user->save();

            session()->forget('code_attempts'); // 🔄 Réinitialisation du compteur

            Mail::to($user->email)->send(new RegisterMail($user));

            return redirect('/dashboard');
        }

        // Si le code est incorrect → on incrémente
        $attempts++;
        session()->put('code_attempts', $attempts);

        // Si l’utilisateur dépasse les 5 essais → supprimer
        if ($attempts >= 5) {
            $user->delete(); // ❌ Suppression du compte
            Auth::logout();
            session()->forget('code_attempts');

            return redirect()->route('register')->withErrors([
                'code' => 'Trop de tentatives. Ton compte a été supprimé.'
            ]);
        }

        // Sinon → renvoyer vers la vue avec message et compteur
        return back()->withErrors([
            'code' => "Code invalide. Tentative {$attempts} sur 5."
        ]);
    }
}
