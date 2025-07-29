<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifMail;
use App\Mail\ConfirMail;
use App\Mail\NotifRhMail;
use Carbon\Carbon;


class DossierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $dossiers = Dossier::orderByDesc('created_at')->get();
            return view('GestionDossier', compact('dossiers'));
        } else {
            $dossiers = $user->dossiers()
                ->orderByDesc('created_at')
                ->get();
            return view('suivie', compact('dossiers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('demande');
        // Formulaire pour créer un nouveau dossier
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //  Validation des données reçues du formulaire
        $validated = $request->validate([
            'montant' => 'required|numeric|min:1|max:10000000',
            'fichier' => ' required|file|max:2048',
        ]);

        // Ajout du fichier au dossier
        if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('dossiers', 'public');
            $validated['fichier_path'] = 'storage/' . $path; // chemin public
        }


        //  Ajout des infos qui ne viennent pas du formulaire
        $validated['user_id'] = auth()->id();         // lier à l’utilisateur connecté
        $validated['status'] = 'en_attente';          // valeur par défaut
        $validated['created_at'] = now();             // date de création
        $validated['updated_at'] = now();             // date de mise à jour
        $validated['motif_refus'] = null;             // valeur par défaut

        //  Sauvegarde en base
        $dossier = Dossier::create($validated);
        // Envoi de l'email de notification
        Mail::to(Auth::user()->email)->send(new ConfirMail($dossier));
        Mail::to("RH@emid.ma")->send(new NotifRhMail());

        //  Redirection avec message
        return redirect()->route('dashboard')->with('success', 'Dossier avec fichier créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dossier $dossier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function modifier($id, Request $request)
    {
        $user = Auth::user();
        $dossier = Dossier::findOrFail($id);

        // Vérification des droits
        if ($user->role !== 'admin' && $dossier->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à modifier ce dossier.');
        }

        if ($dossier->statut !== 'en_attente') {
            return redirect()->back()->with('error', 'Vous ne pouvez pas modifier un dossier qui n\'est pas en attente.');
        }

        // Validation des données
        $validated = $request->validate([

            'montant' => 'nullable|numeric|min:0',

        ]);
         if ($request->hasFile('fichier')) {
            $path = $request->file('fichier')->store('dossiers', 'public');
            $validated['fichier_path'] = 'storage/' . $path; // chemin public
        }

        // Ajout des infos de mise à jour
        $validated['updated_by'] = $user->id;
        $validated['updated_at'] = now();

        // Mise à jour du dossier
        $dossier->update($validated);

        return redirect()->back()->with('success', 'Dossier mis à jour !');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dossier = Dossier::with('user')->find($id);
        $validated = $request->validate([
            'statut' => 'required|string|in:Reçu,accepter,refuser,en_cour,envoyer',
        ]);
        $validated['updated_by'] = Auth::id(); // suivier l'utilisateur qui a mis à jour
        $validated['updated_at'] = now(); // set la date de mise à jour
        $validated['motif_refus'] = $request->input('motif_refus', null); // mise à jour du motif de refus
        $dossier->update($validated);


        // Envoi de l'email de notification
        Mail::to($dossier->user->email)->send(new NotifMail($dossier));

        return redirect()->back()->with('success', 'Dossier mis à jour !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dossier $dossier, $id)
    {
        // Vérification que l'utilisateur est autorisé à supprimer le dossier
        $dossier = Dossier::findOrFail($id);
        $statut = $dossier->statut;
        $user = Auth::user();


        if ($statut == 'en_attente') {
            // Suppression du dossier
            $dossier->delete();

            // Redirection avec message de succès
            return redirect()->back()->with('success', 'Dossier supprimé avec succès.');
        } else {
            // Redirection avec message d'erreur
            return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer un dossier qui n\'est pas en attente.');
        }
    }



    public function chart()
    {


        $startDate = Carbon::create(2025, 1, 1)->startOfMonth();

        $labels = [];
        $data = [];

        for ($i = 0; $i < 12; $i++) {
            $month = $startDate->copy()->addMonths($i);
            $labels[] = $month->format('M Y'); //
            $count = Dossier::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $data[] = $count;
        }

        return view('dashboardadmin', [
            'chartLabels' => $labels,
            'chartData' => $data,
        ]);
    }
}
?>
