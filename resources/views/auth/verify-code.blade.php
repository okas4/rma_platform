<x-guest-layout>

        <form method="POST" action="{{ route('verification.check') }}">
            @csrf

            <div>
                <x-input-label for="code" value="Code de vérification" />
                <x-text-input id="code" name="code" type="text" required autofocus />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    Vérifier
                </x-primary-button>
            </div>
        </form>

</x-guest-layout>
