<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1 class="text-center text-black dark:text-white uppercase">{{ __('message.confTransfert') }}</h1>
        @php
            // dd($interac);
        @endphp
        <div class="overflow-hidden shadow-sm rounded-lg">
            <div class="my-4 text-black dark:text-white">
                {{ $interac['type'] == 'depot' ? "Vous souhaitez recharger votre compte par interac. Vérifiez les informations :" : "Vous souhaiter débiter votere compte Worldsend par Interac. Vérifiez les informations :" }}
                <ol>
                    <li class="m-2"><span class="font-semibold">{{ __('message.name') }} </span>: {{ $interac['name'] }}</li>
                    <li class="m-2"><span class="font-semibold">{{ __('Tel') }} </span>: {{ $interac['tel'] }} </li>
                    <li class="m-2"><span class="font-semibold">{{ __('Email') }} </span>: {{ $interac['email'] }} </li>
                    <li class="m-2"><span class="font-semibold">{{ __('message.bank') }} </span>: {{ $interac['bank'] }} </li>
                    <li class="m-2"><span class="font-semibold">{{ __('message.amount') }} </span>: {{ $interac['amount'] }} </li>
                    <li class="m-2"><span class="font-semibold">{{ __('message.country') }} </span>: {{ $interac['country'] }} </li>
                </ol>
            </div>
        </div>
        <form action="{{ route('interac-confirm') }}" method="post">
            @csrf

            <div class="flex items-center mt-4">
                <input type="hidden" name="name" value="{{ $interac['name'] }}">
                <input type="hidden" name="tel" value="{{ $interac['tel'] }}">
                <input type="hidden" name="bank" value="{{ $interac['bank'] }}">
                <input type="hidden" name="email" value="{{ $interac['email'] }}">
                <input type="hidden" name="country" value="{{ $interac['country'] }}">
                <input type="hidden" name="amount" value="{{ $interac['amount'] }}">
                <input type="hidden" name="type" value="{{ $interac['type'] }}">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-modal')"
                    type="button" class="w-full">
                    {{ __('message.confirm') }}
                </x-primary-button>
            </div>

            <x-modal class="m-4" name="confirm-modal" :show="$errors->isNotEmpty()" focusable>
                <div class="m-6">
                    <x-input-label for="password" value="{{ __('message.password') }}"
                        class="text-gray-900 dark:text-gray-100" />

                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="m-6 flex justify-end">
                    <x-danger-button type="button" x-on:click="$dispatch('close')">
                        {{ __('message.cancel') }}
                    </x-danger-button>

                    <x-primary-button class="ms-3">
                        {{ __('message.confirm') }}
                    </x-primary-button>
                </div>
            </x-modal>
        </form>
    </div>
</x-app-layout>
