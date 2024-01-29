<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('assets/img/500.svg') }}" alt="Internal Error">
    <h1 class="text-white my-2">Une erreur est survenue lors du traitement de votre requête</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ url()->previous() }}">Retour</x-nav-link>
</x-guest-layout>