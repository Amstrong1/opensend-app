<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/done.svg') }}" alt="Success">
    <h1 class="text-black dark:text-white my-2">Opération éffectué avec succès</h1>
    <a href="{{ route('dashboard') }}">
        <x-primary-button class="my-2 underline w-full flex justify-between">
            <span>Continuer</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6 inline-block">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
            </svg>
        </x-primary-button>
    </a>
</x-guest-layout>
