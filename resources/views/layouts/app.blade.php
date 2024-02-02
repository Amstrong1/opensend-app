<!DOCTYPE html>
<html x-data="{ darkMode: false }" :class="{ 'dark': darkMode }" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        @font-face {
            font-family: "Jumper";
            src: url("{{ asset('fonts/JumperPERSONALUSEONLY-Regular.ttf') }}");
        }

        @font-face {
            font-family: "Arial";
            src: url("{{ asset('fonts/ARIAL.TTF') }}");
        }

        body {
            font-family: "Arial";
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Jumper";
        }
    </style>
    @laravelPWA
</head>

<body class="antialiased min-h-screen bg-gray-100 dark:bg-gray-900">
    <header class="sticky w-full top-0 z-50">
        @include('layouts.navigation')
    </header>

    <!-- Page Content -->
    <main class="pb-20">
        {{ $slot }}
    </main>

    <footer class="w-full h-max">
        @include('layouts.bottom-bar')
    </footer>

    @include('sweetalert::alert')

    <script src="https://cdn.kkiapay.me/k.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script>
        function showBalance() {
            document.getElementById('view1').classList.add("hidden");
            document.getElementById('view2').classList.remove("hidden");
            document.getElementById('balance').classList.remove("hidden");
            document.getElementById('balancex').classList.add("hidden");
        }

        function hideBalance() {
            document.getElementById('view1').classList.remove("hidden");
            document.getElementById('view2').classList.add("hidden");
            document.getElementById('balance').classList.add("hidden");
            document.getElementById('balancex').classList.remove("hidden");
        }

        function checkPayment() {
            if (document.getElementById('payment_method').value == 'kkiapay') {
                openKkiapayWidget({
                    amount: document.getElementById('amount').value,
                    position: "right",
                    callback: "success",
                    data: "",
                    theme: "",
                    sandbox: "true",
                    key: "298dba30723511ec9f5205a1aca9c042"
                })
                return false;
            }
            if (document.getElementById('payment_method').value == 'stripe') {
                window.location.replace("/checkout");
            }
        }

        function copy() {
            // Sélectionne le contenu de la div
            var uuid = document.getElementById('uuid');
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNodeContents(uuid);
            selection.removeAllRanges();
            selection.addRange(range);

            // Copie le contenu sélectionné dans le presse-papiers
            document.execCommand('copy');

            // Désélectionne le texte après la copie
            selection.removeAllRanges();
        }
    </script>
</body>

</html>
