<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1 class="text-center text-black dark:text-white uppercase">{{ __('message.transfert') }}</h1>
        <form action="{{ route('interac.store') }}" method="post">
            @csrf
            <input type="hidden" name="type" value="depot">
            <div class="mt-4">
                <x-input-label for="name" :value="__('message.name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="tel" :value="__('Tel')" />
                <x-text-input id="tel" class="block mt-1 w-full" type="tel" name="tel" :value="old('tel')"
                    required autofocus />
                <x-input-error :messages="$errors->get('tel')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="country" :value="__('message.country')" />
                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')"
                    required autofocus />
                <x-input-error :messages="$errors->get('country')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="amount" :value="__('message.amount')" />
                <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')"
                    step="0.01" required autofocus />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="bank" :value="__('message.bank')" />
                <x-text-input id="bank" class="block mt-1 w-full" type="text" name="bank" :value="old('bank')"
                    required autofocus />
                <x-input-error :messages="$errors->get('bank')" class="mt-2" />
            </div>

            <div class="flex items-center mt-4">
                <x-primary-button class="w-full">
                    {{ __('message.send') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
