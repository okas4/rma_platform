<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255','regex:/^[a-zA-Z0-9._%+-]+@emid.ma$/', 'unique:'.User::class],
            'cin'=> ['required', 'string', 'max:20', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'cin' => $request->input('cin'),
            'password' => Hash::make($request->input('password')),
            'verification_code' => rand(100000, 999999),
        ]);

        event(new Registered($user));

        Auth::login($user);
        // Envoi de l'email de confirmation
        Mail::to($user->email)->send(new VerificationCodeMail($user));



        return redirect(route('verification.form', absolute: false));
    }
}
