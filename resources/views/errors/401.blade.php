<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/401.svg') }}" alt="Not authorized">
    <h1 class="text-white my-2">Vous tentez d'accéder à une ressource à laquelle vous n'êtes pas autorisée</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ url()->previous() }}">Retour</x-nav-link>
</x-guest-layout>