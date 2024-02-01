<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1 class="text-center">Envoyer de l'argent</h1>
        <form action="" method="post">
            @csrf
            <div class="mt-4">
                <x-input-label for="amount" :value="__('Montant')" />
                <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" step="0.01"
                    required autofocus />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="uuid" :value="__('Identifiant du destinataire')" />
                <x-text-input id="uuid" class="block mt-1 w-full" type="text" name="uuid" :value="old('uuid')"
                    required autofocus />
                <x-input-error :messages="$errors->get('uuid')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="motif" :value="__('Motif')" />
                <x-text-input id="motif" class="block mt-1 w-full" type="text" name="motif" :value="old('motif')"
                    required autofocus />
                <x-input-error :messages="$errors->get('motif')" class="mt-2" />
            </div>

            <div class="flex items-center mt-4">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-modal')" type="button" class="w-full">
                    {{ __('Send') }}
                </x-primary-button>
            </div>

            <x-modal class="m-4" name="confirm-modal" :show="$errors->isNotEmpty()" focusable>
                @csrf

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
