<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1 class="text-center text-black dark:text-white uppercase">{{ __('message.cashout') }}</h1>
        <form action="" method="post">
            @csrf
            <div class="mt-4">
                <x-input-label for="amount" :value="__('message.amount') . ' ' . Auth::user()->currency" />
                <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')"
                    step="0.01" required autofocus />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
            {{-- <div class="mt-4">
                <x-input-label for="currency" :value="__('message.currency')" />
                <select id="currency" type="text" name="currency" :value="old('currency')" required
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full p-2">
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                    <option value="CAD">CAD</option>
                    <option value="XOF">XOF</option>
                </select>
                <x-input-error :messages="$errors->get('currency')" class="mt-2" />
            </div> --}}
            <div class="mt-4">
                <x-input-label for="payment_method" :value="__('message.mPayment')" />
                <select id="payment_method" type="text" name="payment_method" :value="old('payment_method')" onchange="showPartner(this)" required
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full p-2">
                    <option value="instant">Instantané</option>
                    <option value="cash">Auprès d'un partenaire</option>
                </select>
                <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
            </div>
            <div id="dest1" class="mt-4">
                <x-input-label for="destination1" :value="__('N° Tel')" />
                <x-text-input id="destination1" class="block mt-1 w-full" type="text" name="destination"
                    :value="old('destination1')" />
                <x-input-error :messages="$errors->get('destination1')" class="mt-2" />
            </div>
            <div id="dest2" class="mt-4 hidden">
                <x-input-label for="destination2" :value="__('message.partner')" />
                <x-text-input id="destination2" class="block mt-1 w-full" type="text" name="destination"
                    :value="old('destination2')" />
                <x-input-error :messages="$errors->get('destination2')" class="mt-2" />
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
                    {{ __('message.send') }}
                </x-primary-button>
            </div>

            <x-modal class="m-4" name="confirm-modal" :show="$errors->isNotEmpty()" focusable>
                @csrf

                <div class="m-6">
                    <x-input-label for="password" value="{{ __('message.password') }}"
                        class="text-gray-900 dark:text-gray-100" />

                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="m-6 flex justify-end">
                    <x-danger-button type="button" x-on:click="$dispatch('close')">
                        {{ __('message.cancel') }}
                    </x-danger-button>

                    <x-primary-button class="ms-3">
                        {{ __('message.confirm') }}
                    </x-primary-button>
                </div>
            </x-modal>
        </form>

        <div class="overflow-hidden shadow-sm rounded-lg">
            <div class="my-4 text-black dark:text-white">
                {{ __('message.withdrawDesc') }}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function showPartner(obj) {
        if (obj.value == 'cash') {
            var x = document.getElementById("dest1").style.display = "none";
            var x = document.getElementById("dest2").style.display = "block";
        } else {
            var x = document.getElementById("dest1").style.display = "block";
            var x = document.getElementById("dest2").style.display = "none";
        }
    }
</script>
