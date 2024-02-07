<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('message.infoProfile') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('message.upAccount') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('message.name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('message.unverified') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('message.reMail') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('message.vLink') }}
                        </p>
                    @endif
                </div>
            @endif

            <div>
                <x-input-label for="tel" :value="__('Tel')" />
                <x-text-input id="tel" name="tel" type="text" class="mt-1 block w-full" :value="old('tel', $user->tel)"
                    required autofocus autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('tel')" />
            </div>

            <div>
                {{-- <x-input-label for="country" :value="__('message.country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->country)"
                    required autofocus autocomplete="country" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" /> --}}

                <x-input-label for="country" :value="__('message.country')" />
                <select onchange="setCurrency(this)" id="country" name="country" id="country" onchange="setCurrency(this)"
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full p-2">
                    @foreach ($pays as $continent => $paysContinent)
                        <optgroup label="{{ $continent }}">
                            @foreach ($paysContinent as $value => $label)
                                <option @if (old('country', $user->country) == $value) selected @endif value="{{ $value }}">
                                    {{ $label }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>

            <div>
                <x-input-label for="city" :value="__('message.city')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)"
                    required autofocus autocomplete="city" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="address" :value="__('message.address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)"
                    required autofocus autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>

            <div>
                <x-input-label for="currency" :value="__('message.currency')" />
                <x-text-input id="currency" name="currency" type="text" class="mt-1 block w-full" :value="old('currency', $user->currency)"
                    required autofocus autocomplete="currency" readonly />
                <x-input-error class="mt-2" :messages="$errors->get('currency')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('message.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.saved') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function setCurrency(obj) {
        var label = obj.selectedOptions[0].parentElement.label,
            country = obj.selectedOptions[0].value;
        if (label === "Africa") {
            document.getElementById('currency').value = 'XOF';
        }
        if (label === "Europe") {
            document.getElementById('currency').value = 'EUR';
        }
        if (country === "United Kingdom") {
            document.getElementById('currency').value = 'GBP';
        } else if (country === "Canada") {
            document.getElementById('currency').value = 'CAD';
        } else if (country === "United States") {
            document.getElementById('currency').value = 'USD';
        }
    }
</script>