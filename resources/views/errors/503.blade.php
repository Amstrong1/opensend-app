<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/503.svg') }}" alt="Service Unavailable">
    <h1 class="text-black dark:text-white my-2">La ressource a laquelle vous tentez d'accéder est temporairement indisponible. Veuillez patienter</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ url()->current() }}">Rafraichir</x-nav-link>
</x-guest-layout>