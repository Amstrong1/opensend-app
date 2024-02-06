<x-guest-layout>
    <form method="POST" action="{{ route('confirm') }}">
        @csrf

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Si vous venez de créer un compte, veuillez patienter, nous allons envoyer un code à votre adresse email dès que votre compte sera activé.') }}
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="code" :value="__('message.code')" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required
                autofocus autocomplete="code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <x-primary-button class="w-full">
                {{ __('message.send') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
