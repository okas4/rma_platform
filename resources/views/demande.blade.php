<x-app-layout>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Demande') }}
        </h2>
    </x-slot>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-8 col-lg-6 bg-white p-5 shadow rounded">
            <h2 class=" font-weight-bold text-center mb-4 ">Nouvelle Demande</h2>

            <form action="{{ route('dossiers.store') }}"  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="montant" class="form-label">Montant</label>
                    <input type="number" name="montant" class="form-control" id="montant" placeholder="Ecriver le montant" required></input>
                </div>


                <div class="mb-4">
                    <label for="fichier" class="form-label">Fichier à joindre (PDF, JPG, PNG)</label>
                    <input type="file" name="fichier" class="form-control" id="fichier" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">Valider la demande</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
