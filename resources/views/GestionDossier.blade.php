<x-app-layout>
    <style>
    .bg-indigo-light {
        background-color:rgba(99, 101, 241, 0.26); /* Indigo clair transparent */
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suivi des demandes') }}
        </h2>
    </x-slot>

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a href="{{ route('dashboardadmin') }}" class="nav-link ">Tableau de bord</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('GestionUtilisateur') }}">Utilisateurs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('dossiers.index') }}">Demandes</a>
        </li>

    </ul>

    <div class="container py-5 ">
        <div class="card shadow-sm bg-indigo-light">
            <div class="card-body">


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($dossiers->isEmpty())
                    <p class="text-muted">Aucun dossier pour le moment.</p>
                @else
                    <div id="statusFilter" class="mb-3 d-flex gap-3">
                        <button class="btn btn-secondary filter-btn active" data-status=""
                            style="width: 120px; height: 40px;">TOUS</button>
                        <button class="btn btn-warning filter-btn" data-status="en attente"
                            style="width: 120px; height: 40px;">EN ATTENTE</button>

                        <button class="btn btn-dark filter-btn" data-status="Reçus"
                            style="width: 120px; height: 40px;">RECUS </button>
                        <button class="btn btn-secondary filter-btn" data-status="envoyé"
                            style="width: 120px; height: 40px;">ENVOYER</button>
                        <button class="btn btn-info filter-btn" data-status="En cours"
                            style="width: 120px; height: 40px;">EN COURS</button>
                        <button class="btn btn-success filter-btn" data-status="Remboursé"
                            style="width: 120px; height: 40px;">REMBOUSER</button>
                        <button class="btn btn-danger filter-btn" data-status="Refusé"
                            style="width: 120px; height: 40px;">REFUSER</button>

                    </div>





            </div>


            <div class="table-responsive ">
                <table class="table table-bordered table-striped table-hover bg-white" id="dossiersTable">
                    <thead >
                        <tr>
                            <th>#</th>
                            <th>Employé</th>
                            <th>Montant</th>
                            <th>Status</th>
                            <th>Motifs de refus</th>
                            <th>Date de création</th>
                            <th>Fichier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dossiers as $index => $dossier)
                            <tr class="{{ $rowclass ?? '' }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dossier->user->name }}</td>
                                <td>{{ number_format($dossier->montant, 2) }} MAD</td>
                                <td>
                                    @switch( $statut = $dossier->statut)
                                        @case('en_attente')
                                            <span class="text-warning">En attente de reception</span>
                                        @break
                                        @case('Reçu')
                                        @case('recu')
                                            <span class="text-dark">Recus par le RH</span>
                                        @break

                                        @case('refuser')
                                            <span class="text-danger">Refusé</span>
                                        @break

                                        @case('accepter')
                                            <span class="text-success">Rembourser</span>
                                        @break

                                        @case('en_cour')
                                            <span class="text-info">En cours de traitement</span>
                                        @break
                                        @case('envoyer')
                                            <span class="text-secondary">Envoyé à l'assurance</span>
                                        @break

                                        @default
                                            <span class="text-secondary">{{ $statut }}</span>
                                    @endswitch


                                </td>


                                <td>
                                    @if ($dossier->statut === 'refuser')
                                        <span class="text-muted"> - {{ $dossier->motif_refus }}</span>
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

                                    <div class="btn-group" role="group" aria-label="Actions dossier">
                                        <form action="{{ route('dossier.update', $dossier->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="statut" value="Reçu">
                                            <button type="submit" class="btn btn-outline-dark"
                                                title="Marquer comme reçu"><i class="bi bi-check2"></i></button>
                                        </form>
                                        <form action="{{ route('dossier.update', $dossier->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="statut" value="envoyer">
                                            <button type="submit" class="btn btn-outline-secondary"
                                                title="Envoyer a l'assurance"><i class="bi bi-send-check"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('dossier.update', $dossier->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="statut" value="en_cour">
                                            <button type="submit" class="btn btn-outline-info"
                                                title="En cours de traitement"><i
                                                    class="bi bi-clock-history"></i></button>

                                        </form>
                                        <form action="{{ route('dossier.update', $dossier->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="statut" value="accepter">
                                            <button type="submit" class="btn btn-outline-success" title="Rembourser"><i
                                                    class="bi bi-check2-square"></i></button>
                                        </form>


                                        <!-- Bouton qui déclenche le modal -->
                                        <button type="button" class="btn btn-outline-danger" title="Refuser"
                                            data-bs-toggle="modal" data-bs-target="#modalRefus{{ $dossier->id }}">
                                            <i class="bi bi-x-circle"></i>
                                        </button>


                                    </div>
                                </td>
                            </tr>
                            <!-- petite page flotant -->
                            <div class="modal fade" id="modalRefus{{ $dossier->id }}" tabindex="-1"
                                aria-labelledby="modalLabel{{ $dossier->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('dossier.update', $dossier->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="statut" value="refuser">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $dossier->id }}">Motif de
                                                    refus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Fermer"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="motif_refus_{{ $dossier->id }}">Expliquez le motif
                                                        :</label>
                                                    <textarea name="motif_refus" id="motif_refus_{{ $dossier->id }}" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-danger">Refuser le
                                                    dossier</button>
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

    @push('scripts')
        <script>
            $(document).ready(function() {
                const table = $('#dossiersTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copy',
                            className: 'btn btn-primary btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-secondary btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-success btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-danger btn-sm',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5]
                            }
                        }
                    ]
                });

                // Filtrage dynamique
                $('#statusFilter').on('click', '.filter-btn', function() {
                    $('#statusFilter .filter-btn').removeClass('active');
                    $(this).addClass('active');

                    const selectedStatus = $(this).data('status');
                    table.column(3).search(selectedStatus).draw();
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endpush




</x-app-layout>
