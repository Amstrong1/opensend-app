<x-app-layout>
    <div class="max-w-7xl mx-auto px-8 m-8">
        <h1>Contacter notre service client</h1>
        <div id="app">
            <chat-component :user="{{ auth()->user() }}"></chat-component>
        </div>
    </div>
</x-app-layout>
