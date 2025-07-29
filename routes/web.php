<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DossierController;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifMail;
use App\Http\Middleware\EnsureUserIsVerified;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', EnsureUserIsVerified::class])->name('dashboard');
Route::get('/dashboardadmin', [DossierController::class,'chart'])->middleware(['auth', EnsureUserIsVerified::class])->name('dashboardadmin');
use App\Models\User;

Route::get('/dashboardadmin/GestionUtilisateur', function () {
    $users = User::all();
    return view('GestionUtilisateur', compact('users'));
})->middleware(['auth', 'verified'])->name('GestionUtilisateur');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   Route::put('/dashboard/utilisateur/{id}', [ProfileController::class, 'modifier'])->name('profile.modifier');
    Route::delete('/dashboard/utilisateur/{id}', [ProfileController::class, 'destroyBYAdmin'])->name('profile.destroyBYAdmin');

});
require __DIR__.'/auth.php';
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard/demande', [DossierController::class, 'create'])->name('dossiers.create');
    Route::post('dashboard/demande', [DossierController::class, 'store'])->name('dossiers.store');
    Route::post('dashboard/suivie/{id}', [DossierController::class, 'modifier'])->name('dossiers.modifier');
    Route::get('dashboard/suivie', [DossierController::class, 'index'])->name('dossiers.index');
    Route::delete('dashboard/suivie/{id}', [DossierController::class, 'destroy'])->name('dossiers.destroy');
    Route::resource('dashboardadmin/dossier', DossierController::class);

});


// mail
use App\Models\Dossier;

Route::get('/mailtest', function () {
    $dossier = Dossier::with('user')->find(5);
    $user = $dossier->user;
    Mail::to($user->email)->send(new NotifMail($dossier));
});

