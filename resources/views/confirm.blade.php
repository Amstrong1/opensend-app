<x-guest-layout>
    <form method="POST" action="{{ route('confirm') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="code" :value="__('Code envoyé par mail ' . session('code'))" />
            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required
                autofocus autocomplete="code" />
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <x-primary-button class="w-full">
                {{ __('Send') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
