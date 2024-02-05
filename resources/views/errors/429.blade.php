<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/429.svg') }}" alt="Too many request">
    <h1 class="text-black dark:text-white my-2">En essayant d'accéder à cette ressource vous avez été rediriger trop de fois</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ url()->previous() }}">Retour</x-nav-link>
</x-guest-layout>