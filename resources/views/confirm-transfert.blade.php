<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1 class="text-center text-black dark:text-white uppercase">Confirmer le transfert</h1>

        <div class="overflow-hidden shadow-sm rounded-lg">
            <div class="my-4 text-black dark:text-white">
                Vous souhaitez envoyer un montant de ${{ $transfert['amount'] }} à {{ $transfert['receiver'] }}.
            </div>
        </div>
        <form action="{{ route('transfer-validation') }}" method="post">
            @csrf

            <div class="my-4 text-black dark:text-white">Confirmer le transfert</div>
            <div class="flex items-center mt-4">
                <input type="hidden" name="amount" value="{{ $transfert['amount'] }}">
                <input type="hidden" name="uuid" value="{{ $transfert['uuid'] }}">
                <input type="hidden" name="motif" value="{{ $transfert['motif'] }}">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-modal')"
                    type="button" class="w-full">
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>

            <x-modal class="m-4" name="confirm-modal" :show="$errors->isNotEmpty()" focusable>
                <div class="m-6">
                    <x-input-label for="password" value="{{ __('Votre mot de passe') }}"
                        class="text-gray-900 dark:text-gray-100" />

                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="m-6 flex justify-end">
                    <x-danger-button type="button" x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-danger-button>

                    <x-primary-button class="ms-3">
                        {{ __('Confirm') }}
                    </x-primary-button>
                </div>
            </x-modal>
        </form>
    </div>
</x-app-layout>
