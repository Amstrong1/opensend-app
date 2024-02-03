<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 sm:bg-gray-100 md:bg-white sm:dark:bg-gray-900 md:dark:bg-gray-800 md:shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>

    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
                document.getElementById('view1').classList.add("hidden");
                document.getElementById('view2').classList.remove("hidden");

                if (document.getElementById('password_confirmation') !== null) {
                    document.getElementById('password_confirmation').type = "text";
                }
            } else {
                x.type = "password";
                document.getElementById('view1').classList.remove("hidden");
                document.getElementById('view2').classList.add("hidden");

                if (document.getElementById('password_confirmation') !== null) {
                    document.getElementById('password_confirmation').type = "password";
                }
            }
        }
    </script>
</body>

</html>
