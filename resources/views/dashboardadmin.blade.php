<x-app-layout>

        <style>
            .bg-indigo-light {
                background-color: rgba(99, 101, 241, 0.26);

            }

            .card-indigo {
                background-color: #4B0082;

                color: white;
            }

            .card-indigo h6 {
                color: rgba(230, 230, 230, 0.692);

            }
        </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>


    <div class="container py-6 px-4 ">
        {{-- Navigation par onglets --}}
        <ul class="nav nav-tabs mb-6">
            <li class="nav-item">
                <a href="{{ route('dashboardadmin') }}"
                    class="nav-link {{ request()->routeIs('dashboardadmin') ? 'active' : '' }}">
                    Tableau de bord
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('GestionUtilisateur') ? 'active' : '' }}"
                    href="{{ route('GestionUtilisateur') }}">Utilisateurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dossiers.index') ? 'active' : '' }}"
                    href="{{ route('dossiers.index') }}">Demandes</a>
            </li>

        </ul>

        {{-- Statistiques --}}
        @php
            $total = \App\Models\Dossier::count();
            $recu = \App\Models\Dossier::where('statut', 'Reçu')->count();
            $accepte = \App\Models\Dossier::where('statut', 'accepter')->count();
            $refuse = \App\Models\Dossier::where('statut', 'refuser')->count();
            $attente = \App\Models\Dossier::where('statut', 'en_attente')->count();
            $envoyer = \App\Models\Dossier::where('statut', 'envoyer')->count();
            $cours = \App\Models\Dossier::where('statut', 'en_cour')->count();
        @endphp


        <div class="container mt-4 bg-indigo-light rounded p-3">
            <div class="row">
                {{-- Colonne gauche : Carte Total --}}
                <div class="col-md-3 mt-3 mb-3">
                    <div class="card card-indigo h-100">
                        <div class="card-body d-flex flex-column justify-content-between" style="min-height: 100%;">
                            <div>
                                <h6>Total Dossiers</h6>
                                <h2>{{ $total }}</h2>

                            </div>
                            <div>
                                <h6></h6>
                            </div>
                            <i class="bi bi-folder display-6 opacity-50 align-self-end"></i>
                        </div>
                    </div>
                </div>

                {{-- Colonne droite : Grille 2x3 --}}
                <div class="col-md-9">
                    <div class="row">
                        {{-- Première ligne --}}
                        <div class="col-md-4 mb-3 mt-3">
                            <div class="card card-indigo">
                                <div class="card-body">
                                    <h6>En Attente</h6>
                                    <h2>{{ $attente }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mt-3">
                            <div class="card card-indigo">
                                <div class="card-body">
                                    <h6>Reçus</h6>
                                    <h2>{{ $recu }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 mt-3">
                            <div class="card card-indigo">
                                <div class="card-body">
                                    <h6>Envoyés</h6>
                                    <h2>{{ $envoyer }}</h2>
                                </div>
                            </div>
                        </div>

                        {{-- Deuxième ligne --}}
                        <div class="col-md-4 mb-3">
                            <div class="card card-indigo">
                                <div class="card-body">
                                    <h6>Remboursés</h6>
                                    <h2>{{ $accepte }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card card-indigo">
                                <div class="card-body">
                                    <h6>Refusés</h6>
                                    <h2>{{ $refuse }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card card-indigo">
                                <div class="card-body">
                                    <h6>En Cours</h6>
                                    <h2>{{ $cours }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        {{-- Graphique --}}
        <div class="mt-5 card shadow-sm bg-white">
            <div class="card-header bg-indigo-light border-bottom">
                <h5 class="mb-0 ">Évolution des demandes</h5>
            </div>
            <div class="card-body" style="height: 400px;">
                <canvas id="dossiersChart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('dossiersChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartLabels ?? []) !!},
                    datasets: [{
                        label: 'Dossiers par mois',
                        data: {!! json_encode($chartData ?? []) !!},
                        backgroundColor: 'rgba(75, 0,130, 0.7)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1


                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
