<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suivi des demandes') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-4 text-primary">Suivi des demandes</h4>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($dossiers->isEmpty())
                    <p class="text-muted">Aucun dossier pour le moment.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Montant</th>
                                    <th>Status</th>
                                    <th>Motifs de refus</th>
                                    <th>Date de création</th>
                                    <th>Fichier</th>
                                    <th>Supprimer/Modifier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dossiers as $index => $dossier)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ number_format($dossier->montant, 2) }} MAD</td>
                                        <td>
                                            @switch($dossier->statut)
                                                @case('en_attente')
                                                    En attente de reception
                                                @break

                                                @case('Reçu')
                                                    Reçus par la RH
                                                @break

                                                @case('accepter')
                                                    Remboursé
                                                @break

                                                @case('refuser')
                                                    Refusé
                                                @break

                                                @case('en_cour')
                                                    En cours de traitement
                                                @break

                                                @case('envoyer')
                                                    Envoyé a l'assurance
                                                @break

                                                @default
                                                    {{ $dossier->statut }}
                                            @endswitch
                                        </td>
                                        <td>
                                            @if ($dossier->statut === 'refuser')
                                                {{ $dossier->motif_refus }}
                                            @else
                                                <span class="text-muted">RAS</span>
                                            @endif

                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($dossier->created_at)->format('d/m/Y à H:i') }}
                                        </td>
                                        <td>
                                            @if ($dossier->fichier_path)
                                                <a href="{{ asset($dossier->fichier_path) }}" target="_blank"
                                                    class="btn btn-sm btn-primary">Voir</a>
                                            @else
                                                <span class="text-muted">Aucun fichier</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('dossiers.destroy', $dossier->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce dossier ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    title="Supprimer">Supprimer</button>
                                            </form>
                                            <button type="button" class="btn btn-outline-primary"
                                                data-bs-toggle="modal" data-bs-target="#editModal-{{ $dossier->id }}">
                                                Modifier
                                            </button>
                                        </td>

                                    </tr>
                                    <div class="modal fade"id="editModal-{{ $dossier->id }}" tabindex="-1"
                                        aria-labelledby="editModalLabel-{{ $dossier->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content shadow border-0">
                                                <form action="{{ route('dossiers.modifier', $dossier->id) }}"
                                                    method="post">
                                                    @csrf

                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editModalLabel-{{ $dossier->id }}">Modifier le dossier
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="modal-body bg-light">
                                                            <div class="mb-3">
                                                                <label for="montant" class="form-label">Montant</label>
                                                                <input type="number" name="montant"
                                                                    class="form-control" id="montant"
                                                                    placeholder="Ecriver le montant"
                                                                    value="{{ old('montant', $dossier->montant) }}"></input>
                                                            </div>


                                                            <div class="mb-4">
                                                                <label for="fichier" class="form-label">Fichier à
                                                                    joindre (PDF, JPG, PNG)</label>
                                                                <input type="file" name="fichier"
                                                                    class="form-control" id="fichier"
                                                                    value="{{ old('fichier', $dossier->fichier_path) }}"
                                                                    accept=".pdf,.jpg,.jpeg,.png">
                                                            </div>

                                                            <div class="modal-footer bg-white">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Enregistrer</button>
                                                            </div>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
