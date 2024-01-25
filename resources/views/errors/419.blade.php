<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/419.svg') }}" alt="Expired">
    <h1 class="text-white my-2">Votre requête a déja expiré</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ route('dashboard') }}">Retour</x-nav-link>
</x-guest-layout>