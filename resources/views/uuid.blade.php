<x-app-layout>
    <div class="grid grid-cols-1 gap-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mx-8 my-4 w-full">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mx-4 text-center">
                <div class="p-6 text-white">

                    <div class="font-bold">
                        <div class="relative h-0" style="bottom: 5px; left: 85%">
                            <svg id="view1" onclick="showBalance()" xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg id="view2" onclick="hideBalance()" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </div>
                    </div>

                    <div class="p-4 text-white bg-gray-800">
                        <div id="balancex">{{ __('Mon UUID') }}</div>
                        <div id="balance" class="hidden">{{ __("$ " . Auth::user()->openid) }}</div>
                        <input type="hidden" id="uuid" value="{{ Auth::user()->openid }}">
                    </div>

                    <button onclick="copy()"
                        style="background-color: #ee273b" class="p-2 rounded text-white w-full">
                        <p>{{ __('Copier') }}</p>
                    </button>
                </div>
            </div>

            <div class="overflow-hidden shadow-sm rounded-lg mx-4">
                <div class="p-6 text-white">
                    Votre UUID représente votre identifiant OpenSend unique. Elle vous permet de sécuriser votre compte et de recevoir des transferts.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
