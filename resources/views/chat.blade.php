<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 m-8">
        <h1 class="text-center text-black dark:text-white uppercase">{{ __('message.chat') }}</h1>
        <div id="app">
            <chat-component :user="{{ Auth::user() }}"></chat-component>
        </div>
    </div>
</x-app-layout>
