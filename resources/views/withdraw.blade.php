<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1 class="text-center text-black dark:text-white uppercase">Retirer de l'argent</h1>
        <form action="" method="post">
            @csrf
            <div class="mt-4">
                <x-input-label for="amount" :value="__('Montant')" />
                <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')"
                    step="0.01" required autofocus />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="currency" :value="__('Currency')" />
                <select id="currency" type="text" name="currency" :value="old('currency')" required
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full p-2">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="CAD">CAD</option>
                    <option value="XOF">XOF</option>
                </select>
                <x-input-error :messages="$errors->get('currency')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="destination" :value="__('ID Opensend du partenaire Agréé')" />
                <x-text-input id="destination" class="block mt-1 w-full" type="text" name="destination"
                    :value="old('destination')" required />
                <x-input-error :messages="$errors->get('destination')" class="mt-2" />
            </div>
            {{-- <div class="mt-4">
                <x-input-label for="transfer_group" :value="__('Transfert group')" />
                <x-text-input id="transfer_group" class="block mt-1 w-full" type="text" name="transfer_group"
                    :value="old('transfer_group')" required />
                <x-input-error :messages="$errors->get('transfer_group')" class="mt-2" />
            </div> --}}

            <div class="flex items-center mt-4">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-modal')"
                    type="button" class="w-full">
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

        <div class="overflow-hidden shadow-sm rounded-lg">
            <div class="my-4 text-black dark:text-white">
                Vérifiez bien les informations avant de soumettre le formulaire. Votre compte OpenSend sera débité du montant saisis. Vous pouvez le récupérer en espèce auprès du partenaire agréé. C'est rapide et sécurisé.
            </div>
        </div>
    </div>
</x-app-layout>
