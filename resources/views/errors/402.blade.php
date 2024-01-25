<x-guest-layout>
    <img class="w-48 block mx-auto" src="{{ asset('img/402.svg') }}" alt="Required payment">
    <h1 class="text-white my-2">L'accès a cette ressource nécéssite un paiement</h1>
        <x-nav-link class="text-white hover:text-white my-2 underline" href="{{ url()->previous() }}">Retour</x-nav-link>
</x-guest-layout>