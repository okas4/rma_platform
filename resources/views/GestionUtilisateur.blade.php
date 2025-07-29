<x-app-layout>
    <style>
        .bg-indigo-light {
            background-color: rgba(99, 101, 241, 0.26);
            /* Indigo clair transparent */
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Gestion des Utilisateurs') }}
        </h2>
    </x-slot>


    <div class="container py-4">
        {{-- Navigation par onglets --}}
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a href="{{ route('dashboardadmin') }}" class="nav-link ">Tableau de bord</a>

            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('GestionUtilisateur') }}">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dossiers.index') }}">Demandes</a>
            </li>

        </ul>

        <div class="container py-5">
            <div class="card shadow-sm bg-indigo-light"> ">
                <div class="card-body">


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

                    @if ($users->isEmpty())
                        <p class="text-muted">Aucun utilisateur trouvé.</p>
                    @else
                        <table class="table table-striped bg-white" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>CIN</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->cin }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <!-- Bouton modifier -->
                                            <button type="button" class="btn btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editProfileModal-{{ $user->id }}">
                                                Modifier
                                            </button>
                                            <!-- Bouton supprimer -->
                                            <button type="button" class="btn btn-outline-danger ms-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal-{{ $user->id }}">
                                                Supprimer
                                            </button>



                                        </td>
                                    </tr>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editProfileModal-{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="editProfileModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                            <div class="modal-content shadow border-0">
                                                <form method="POST"
                                                    action="{{ route('profile.modifier', $user->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"
                                                            id="editProfileModalLabel-{{ $user->id }}">
                                                            Modifier les informations de {{ $user->name }}
                                                        </h5>
                                                        <button type="button" class="btn-close bg-white"
                                                            data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                    </div>

                                                    <div class="modal-body bg-light">
                                                        <div class="mb-3">
                                                            <label for="name-{{ $user->id }}"
                                                                class="form-label">Nom</label>
                                                            <input type="text" name="name"
                                                                id="name-{{ $user->id }}" class="form-control"
                                                                value="{{ old('name', $user->name) }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="cin-{{ $user->id }}"
                                                                class="form-label">CIN</label>
                                                            <input type="text" name="cin"
                                                                id="cin-{{ $user->id }}" class="form-control"
                                                                value="{{ old('cin', $user->cin) }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email-{{ $user->id }}"
                                                                class="form-label">Email</label>
                                                            <input type="email" name="email"
                                                                id="email-{{ $user->id }}" class="form-control"
                                                                value="{{ old('email', $user->email) }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer bg-white">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit"
                                                            class="btn btn-success">Enregistrer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- modal supprimer  -->
                                    <div class="modal fade" id="confirmDeleteModal-{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteLabel-{{ $user->id }}">
                                                        Confirmer la suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Voulez-vous vraiment supprimer
                                                        <strong>{{ $user->name }}</strong> (CIN:{{ $user->cin }})
                                                        ? Cette action est irréversible.
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('profile.destroyBYAdmin', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Confirmer la
                                                            suppression</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        @push('scripts')
            <script>
                $(document).ready(function() {
                    const table = $('#usersTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [{
                                extend: 'copy',
                                className: 'btn btn-primary btn-sm',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            },
                            {
                                extend: 'csv',
                                className: 'btn btn-secondary btn-sm',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            },
                            {
                                extend: 'excel',
                                className: 'btn btn-success btn-sm',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            },
                            {
                                extend: 'pdf',
                                className: 'btn btn-danger btn-sm',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4]
                                }
                            }
                        ]
                    });
                });
            </script>
        @endpush
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



</x-app-layout>
