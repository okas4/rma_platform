<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="d-flex justify-content-center align-items-center min-vh-100">
            <div class="container">
                <div class="row justify-content-center g-4">
                    <div class="col-12 col-md-5 col-lg-4 mx-3">
                        <div class="card card-hover shadow-sm border-0 h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title titre-carte"> {{ 'Nouvelle Demande' }}</h5>
                                <p class="card-text texte-carte">{{ 'Cliquez ici pour créer une nouvelle demande.' }}
                                </p>
                                <a href="{{ route('dossiers.create') }}"
                                    class="btn btn-primary btn-carte">{{ 'Créer une nouvelle demande' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-lg-4 mx-3">
                        <div class="card card-hover shadow-sm border-0 h-100">
                            <div class="card-body text-center">
                                <h5 class="card-title titre-carte">{{ 'Suivre Mes Demandes' }}</h5>
                                <p class="card-text texte-carte">{{ 'Cliquez ici pour suivre toutes vos demandes.' }}
                                </p>
                                <a href="{{ route('dossiers.index') }}"
                                    class="btn btn-primary btn-carte">{{ 'Suivre Mes Demandes' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </div>
</x-app-layout>
