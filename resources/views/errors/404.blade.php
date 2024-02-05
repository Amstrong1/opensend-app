<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/404.svg') }}" alt="Not found">
    <h1 class="text-black dark:text-white my-2">Vous tentez d'accéder à une ressource qui n'est pas disponible, contactez votre administrateur pour plus
        d'information</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ url()->previous() }}">Retour</x-nav-link>
</x-guest-layout>